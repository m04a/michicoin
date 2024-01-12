<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Symfony\Component\Finder\Finder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Filesystem\Filesystem;

class FnxTranslateController extends Controller
{
    
    public function list(Request $request){   

        if(!backpack_user()->root && !backpack_user()->can('translates')){
            return redirect('admin');
            die();
        }

        $languages = \Config::get('backpack.crud.locales');
        

        $protected = ['validation','auth','passwords','pagination'];

        $lang = \App::getLocale();
        $langpath = resource_path('lang/'.$lang);

        $groups = [];

        foreach (glob($langpath."/*.php") as $filename) {
            $group = str_replace('.php','',basename($filename));
            if(!in_array($group,$protected)){
                $groups[] = $group;
            }
        }

        if(!backpack_user()->root){
            $allowed = ['public','mails','shop'];
            foreach($groups as $k=>$g){
                if(!in_array($g, $allowed)){
                    unset($groups[$k]);
                }
            }
        }

        $group = $request->get('group','public');


       

        $translates = [];
 
        foreach($languages as $olang=>$lang_name){
            $translates[$olang] = Lang::get($group,[],$olang);
        }

        $data['languages'] = $languages;
        $data['translates'] = $translates;
        $data['groups'] = $groups;
        $data['group'] = $group;
        if(!isset($translates[$lang])){
            $translates[$lang] = [];
        }
        elseif(!is_array($translates[$lang])){
            $translates[$lang] = [];
        }
        $data['translates_keys'] =  array_keys($translates[$lang]);


        return view('michicoin.translates.list',$data);

    }


    public function save(Request $request){
        if(!backpack_user()->root && !backpack_user()->can('translates')){
            return redirect('admin');
            die();
        }


       $f = new Filesystem();

       foreach($request->get('translate') as $lang=>$groups){
            $langpath = resource_path('lang/'.$lang);
            foreach($groups as $group=>$translates){

                $currentTranslates = Lang::get($group,[],$lang);
                if(!is_array($currentTranslates)){
                    $currentTranslates = [];
                }


                foreach($translates as $key=>$trans){
                    $currentTranslates[$key] = $trans;
                }

                $output = "<?php\n\nreturn " . var_export($currentTranslates, true) . ";\n";

                //$f->put($langpath.'/'.$group.'.php', $output);
                \Storage::disk('langs')->put($lang.'/'.$group.'.php', $output);
                
            }
       }

       \Alert::add('primary', __('translate.translates_saved'))->flash();;

       return redirect('/admin/translates/list?group='.$group);
    }



    public function scan(){
        if(!backpack_user()->root && !backpack_user()->can('translates')){
            return redirect('admin');
            die();
        }
        $protected = ['validation','auth','passwords','pagination'];

        
        $path = base_path();
        $groupKeys = [];
        //funcions de traduccio per cercar
        $functions =  [
            'trans',
            'trans_choice',
            'Lang::get',
            'Lang::choice',
            'Lang::trans',
            'Lang::transChoice',
            '@lang',
            '@choice',
            '__',
            '$trans.get',
        ];


         $groupPattern =                          // See https://regex101.com/r/WEJqdL/6
            "[^\w|>]".                          // Must not have an alphanum or _ or > before real method
            '('.implode('|', $functions).')'.  // Must start with one of the functions
            "\(".                               // Match opening parenthesis
            "[\'\"]".                           // Match " or '
            '('.                                // Start a new group to match:
            '[a-zA-Z0-9_-]+'.               // Must start with group
            "([.](?! )[^\1)]+)+".             // Be followed by one or more items/keys
            ')'.                                // Close group
            "[\'\"]".                           // Closing quote
            "[\),]";                            // Close parentheses or new parameter

        // Find all PHP  files in the app folder, except for storage
        $finder = new Finder();
        if(is_dir(base_path('modules'))){
            $finder->in(app_path())->in(resource_path())->in(base_path('modules'))->name('*.php')->files();
        }
        else{
            $finder->in(app_path())->in(resource_path())->name('*.php')->files();
        }
        
 
        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder as $file) {
            // Search the current file for the pattern
            if (preg_match_all("/$groupPattern/siU", $file->getContents(), $matches)) {
                // Get all matches
                foreach ($matches[2] as $key) {
                    $groupKeys[] = $key;
                }
            }

        }

       
        // Remove duplicates
        $groupKeys = array_unique($groupKeys);
      
        $grouped = [];

        // Add the translations to the database, if not existing.
        foreach ($groupKeys as $key) {
            // Split the group and item
            list($group, $item) = explode('.', $key, 2);
            $grouped[$group][] = $item;
        }

        $scan_groups = array_keys($grouped);

        $langs = array_keys(config('backpack.crud.locales'));

        $f = new Filesystem();
        $added = 0;



        foreach($langs as $lang){
            $langpath = resource_path('lang/'.$lang);


            $files = File::files($langpath);

           //FIRST: delete groups not present
           foreach($files as $file){
            $fname =  str_replace('.php','',$file->getFilename());
            if(!in_array($fname,$protected) && !in_array($fname,$scan_groups)){
               File::delete($file);
            }
           }

            if(!File::exists($langpath)) {
                // No existe el idioma
                mkdir($langpath, 0755, true);
            }

            foreach($grouped as $group=>$keys){
                 //Si existe cargar fichero

                $langTrans = Lang::get($group,[],$lang);       

               if(!is_array($langTrans)){
                    //No existeix
                    $langTrans = [];
               }


               foreach($langTrans as $k=>$v){
                if(!in_array($k,$keys)){
                    unset($langTrans[$k]);
                }
            }

               foreach($keys as $key){
                if(!isset($langTrans[$key])){
                    $langTrans[$key] = $group.'.'.$key;
                    $added++;
                }
               }

               foreach($langTrans as $key=>$val){
                   $allTrans[$lang][$group][$key] = $val;
               }

                $output = "<?php\n\nreturn " . var_export($langTrans, true) . ";\n";

                $f->put($langpath.'/'.$group.'.php', $output);
            }
           
        }

        \Alert::add('primary', __('translate.translate_scan_finish',['added'=>$added]))->flash();;


        return redirect('admin/translates/list');


    }
}
