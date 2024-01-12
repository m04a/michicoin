<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FnxUrl;
use App\Models\Page;
use App\Models\FnxMenuItem;
use App\Models\FnxCookieCategory;
use App\Models\FnxCookie;
use App\Models\FnxSettings;
use App\Models\Subscriber;
use App\Models\ContactSend;
use App\Models\Redirection;

use App;
use App\Http\Traits\Loaders;
use App\Http\Traits\ContactValidation;
use Config;
use Session;
use Illuminate\Support\Facades\Mail;

class FnxFrontendController extends Controller
{
    use Loaders;
    use ContactValidation;

    
    public function robots(){
        return  getSetting('seo_robots');
    }


    public function themeCSS(){
        header('Content-Type: text/css');

        $theme = getTheme();

        $viewFile = 'themes.'.$theme.'.public.css';

        if (view()->exists($viewFile)) {
            $content = view($viewFile)->render();
            return response($content)
            ->header('Content-Type', 'text/css');
        } 
    }

    public function subscribe(Request $request) {
       
        $validated = $request->validateWithBag('subscribe',[
            'email' => 'required|email',
            'accept_conditions' => 'required'
        ]);
        $exist = Subscriber::where('email',$validated['email'])->first();
        if($exist){
            return back()->with('subscriber_error','exist');
        }
        $subscriber = new Subscriber();
        $subscriber->email = $validated['email'];
        $subscriber->save();
        return back()->with('subscriber_ok','exist');
    }


    public function acceptCookies(Request $request) {
        $categories = FnxCookieCategory::all();
     
        foreach($categories as $cat){
            Session::put('Fnx_Cookies_'.$cat->id,1);

        }
        Session::put('accept_cookies',TRUE);
        $response['head'] =  App\Models\FnxCookie::scripts('head');
        $response['body'] =  App\Models\FnxCookie::scripts('body');
        $response['footer'] =  App\Models\FnxCookie::scripts('footer');
        return response()->json($response);
    }

    public function toggleCookies(Request $request){
        //olvidamos cualquier cookie guardada
        $allcats = FnxCookieCategory::all();
        foreach($allcats as $cat){
            Session::forget('Fnx_Cookies_'.$cat->id);
        }

        $values = explode(';',$request->get('v'));
        foreach($values as $val){
            if($val!=''){
                Session::put('Fnx_Cookies_'.$val,TRUE);
            }
        }

        Session::put('accept_cookies',TRUE);
        $response['head'] =  App\Models\FnxCookie::scripts('head');
        $response['body'] =  App\Models\FnxCookie::scripts('body');
        $response['footer'] =  App\Models\FnxCookie::scripts('footer');
        return response()->json($response);
    }



    public function contact(Request $request){

       $form_function = 'form_'.$request->get('form');

       //Cargamso validaciones i comportamiento definido en el TRAIT ContactValidation
       if(method_exists($this,$form_function)){
            $form = $this->$form_function($request);
        }

        //TODO: enviar ficheros

        if(!isset($form['rules'])){
            return back()->with('error',trans('public.invalid_form'));
        }

        if(isset($form['error'])){
            return back()->with('error',$form['error']);
        }

        //validamos con las reglas que nos han puesto en el ContactValidation
        if($request->has('form_bag')){
            //nos han pedido validar con bag, lo ponemos en un bag
            $request->validateWithBag($request->get('form_bag'),$form['rules']);

        }
        else{
            $request->validate($form['rules']);
        }
        
        $not_send = ['_token','form','g-recaptcha-response'];  //Campos que no enviamos en el formulario

        if(isset($form['not_send'])){
            $not_send = array_merge($not_send, $form['not_send']);  //si la validación quiere otra cosa, se hace otra cosa
        }

        $send_fields = [];
     
        foreach($request->all() as $field=>$value){
            if(!in_array($field,$not_send)){    //només els camps que hem marcat enviables s'enviarán
                $fkey = $form['fname'][$field] ?? $field;

                if(isset($form['replaces'][$field])){
                    if($form['replaces'][$field]!=''){
                        $send_fields[$fkey] =$form['replaces'][$field];
                    }                    
                }
    
                elseif(is_array($value)){
                    $send_fields[$fkey] = json_encode($value);
                }
                else{
                    $send_fields[$fkey] = $value;
                }
                
            }
        }

        $to = $form['to'] ?? getSetting('contact_email');
        
 
        $rd = $form['rd'] ?? '';
        $subject = $form['subject'] ?? __('public.contact_subject');
        $attachments = $form['attachments'] ?? [];
        if(env('FNX_SAVE_SENDFORMS')){
            //cal guardar els contactes
            $cs = new ContactSend();
            $cs->readed = 0;
            $cs->form = $subject;
            $cs->name = $request->get('name');
            $cs->email = $request->get('email');
            $cs->data = $request->except( $send_fields);
            $cs->save();
        }
       // return new App\Mail\Contact($send_fields, $subject,$attachments);
        Mail::to($to)->send(new App\Mail\Contact($send_fields, $subject,$attachments));

       


        $form_function = 'form_post_'.$request->get('form');

        if(method_exists($this,$form_function)){
             $form = $this->$form_function($request);
         }

        if($rd!=''){
            return redirect($rd)->with('success',trans('public.contact_success'));    
        }

        return back()->with('success',trans('public.contact_success'));

    }

    public function showHome($locale=''){
        $homepage_id = getSetting('general_homepage');
        if($locale==Config::get('app.locale')){
            return redirect('');
        }

        if($locale==''){
            $locale = App::getLocale();
        }

        $real_url = FnxUrl::where('model_class','App\Models\Page')->where('locale',$locale)->where('model_id',$homepage_id)->first();

        if($real_url){
            return $this->renderUrl($real_url);
       }
        
    }

    public function sitemap(Request $request){
        $locales =  FnxUrl::distinct('locale')->pluck('locale')->toArray();
        foreach($locales as $locale){
            $urls[$locale] = FnxUrl::where('locale',$locale)->get();
        }
        
        $data['urls'] = $urls;
        $data['locales'] = $locales;
        $data['defloc'] = app()->getLocale();
        $data['homepage_id'] = getSetting('general_homepage');

        return response()->view('michicoin.public.sitemap', $data)->header('Content-Type', 'text/xml');
    }

    public function loadCommonData($url){
        $data = [];

        if(!$url){
            //Miraremos si existe otra url para la
            abort(404);
        }

        $default_locale = Config::get('app.locale');
        App::setLocale($url->locale);
        $model_class =  $url->model_class;
        $model = new $model_class();
        $instance = $model::find($url->model_id);

        if($instance){
            $homepage_id = getSetting('general_homepage');
            if($model_class=='App\Models\Page' && $instance->id==$homepage_id && request()->segment(2)){
                if($url->locale ==  $default_locale){
                    $data['redirect'] = '';
                    return $data;                    
                }
                else{
                    $data['redirect'] = $url->locale;
                    return $data;                  
                }
            }

            $folder = '';
            $loader_function = '';
            if($instance->template_folder!=''){
                $folder = $instance->template_folder.'.';
                $loader_function = $instance->template_folder.'_';
            }

            $loader_function .= $instance->template;
            
            $data = $instance->prepareData($url);

            $data['view'] = $folder.$instance->template;
 
        }
        //Cargamos la pagina home por si nos hace falta algo
        $data['homepage'] = Page::find(getSetting('general_homepage'));
        $data['cookiespage'] = Page::with(['fnx_url'])->where('template','cookies')->first();
        Config::set('fnx_menus',FnxMenuItem::with(['children','children.children'])->where('parent_id',NULL)->orderBy('lft','asc')->get());
        $homepage_url = '';
        if($url->locale!=$default_locale){
            $homepage_url = $url->locale;
        }
        $data['homepage_url'] =  $homepage_url;
        $data['cookies'] =  FnxCookie::all();
        $data['catcookies'] =  FnxCookieCategory::all();

        if(method_exists($this,'common')){
            $data = $this->common($data);
        }

        if($instance && method_exists($this,$loader_function)){
            $data = $this->$loader_function($data);
        }
        
        return $data;
    }

    public function renderUrl($url){

        if(!$url){
            abort(404);
            die();
        }
        
        $data = $this->loadCommonData($url);

        if(isset($data['redirect'])){
            if(isset($data['redirect_with'])){
                $with_key = $data['redirect_with']['key'];
                $with_value = $data['redirect_with']['value'];
                return redirect($data['redirect'])->with($with_key, $with_value);
            }

            return redirect($data['redirect']);
        }

        $theme = getTheme();

        $viewFile = 'themes.'.$theme.'.public.'.$data['view'];

        $viewPath = resource_path('views/themes/'.$theme.'/public/'.str_replace('.','/',$data['view']).'.blade.php');

        if(!file_exists($viewPath)){
            //SIEMPRE DEBEREMOS TENER UN pages.text en TODAS LAS PLANTILLAS
            $viewFile = 'themes.'.$theme.'.public.pages.text';
        }


        return view($viewFile, $data);

    
    }

    public function decodeUrl($lang, $url){

        $real_url = FnxUrl::where('url',$url)->where('locale',$lang)->first();

        if($real_url){
            return $this->renderUrl($real_url);
        }
        
        //Miraremos si existe esa url en otra cosa
        $uri = \Request::getRequestUri();
        $rd = Redirection::where('from',$uri)->first();        
        if(!$rd){
            //intenamos quitando el / del inicio del uri
            $uri = ltrim($uri, '/');
            $rd = Redirection::where('from',$uri)->first();        

        }
        if($rd){
            return redirect($rd->to,$rd->type);
        }

        abort(404);
    }
}
