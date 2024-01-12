<?php

namespace App\Http\Traits;

trait ModelUrl
{

    private function getClassSlug(){
        $classname = explode("\\",get_class($this));
        return strtolower(end($classname));
    }

    public function adminEditUrl(){
        if(isset($this->editpath) && $this->editpath!=''){
            $base = backpack_url($this->editpath);
        }
        else{
            $base = backpack_url($this->getClassSlug());
        }
        return $base.'/'.$this->id.'/edit';
    }

    public function adminName(){
        $cname = $this->getClassSlug();
        return __('template.'.$cname);
    }

    public function fnx_url(){
        $locale = $this->locale;
        if(!$locale){
                $locale = \App::getLocale();
        }
        return $this->hasOne('App\Models\FnxUrl','model_id')->where('locale',$locale)->where('model_class',get_class($this));
    }

    public function getUrlAttribute(){
        if($this->fnx_url){
                return $this->fnx_url->full_url;
        }
        return '';
    }

    public function generateURL($locale=''){
        if($locale==''){
            $locale = $this->locale;
        }
        
        if(!$locale){
                $locale = \App::getLocale();
        }
        $model_class = get_class($this);
        $model_id = $this->id;
        $metas['title'] = $this->title;
        $slug =  Str::slug($this->title);
        if($this->father && $this->father->fnx_url){
            $slug = $this->father->fnx_url->url.'/'.$slug;
        }
        elseif(isset($this->father_page_template)){
            //Su padre es una pàgina
            $parent_slug = $this->father_page_template;
            $parent_page = Page::where('template',$parent_slug)->first();
            if($parent_page){
                $parent_url = FnxUrl::where('locale',$locale)->where('model_class','App\Models\Page')->where('model_id',$parent_page->id)->first();
                if($parent_url){
                    $parent_slug = $parent_url->url;
                }                
            }
            $slug = $parent_slug.'/'.$slug;
        }
       FnxUrl::createUrl($locale, $slug, $metas, $model_class, $model_id);

    }

    public function generateUrls($langs=[]){
        if(empty($langs)){
            $langs = config('backpack.crud.locales');
        }
       foreach($langs as $lang){
            $this->generateURL($lang);
       }

    }



    public function getTemplateAttribute($value){
        if(isset($this->template) && is_null($value)){
            return $this->template;
        }        
        return $value;                
    }


    public function getTemplateNameAttribute(){
        include(resource_path('views/themes/'.getTheme().'/'.$this->templates));
        
        $template_name = $this->template;

        if(isset($templates[$this->template])){
            $template_name = $templates[$this->template]['label'];
        }

        return $template_name;                
    }


    private function decodeField($field, $name, $default = ''){
        if(isset($this->$field)){
            $json = json_decode($this->$field);
            if(isset($json->$name)){
                if(!is_string($json->$name)){
                    return $json->$name;
                }
                $decoded = json_decode($json->$name);
                if(json_last_error() == JSON_ERROR_NONE){
                    return $decoded;
                }
                else{
                    return $json->$name;
                }
            }
        }
        return $default;        
    }

    public function scopeSearch($scopequery, $txt, $fields){
        $txt = '%'.$txt.'%';
        $scopequery->where(function($query) use ($fields, $txt){
            foreach($fields as $p=>$field){
                if($p==0){
                    $query->where($field,'LIKE',$txt);
                }
                else{
                    $query->orWhere($field,'LIKE',$txt);
                }
            }
        });
    }

    public function getContent($name, $default = ''){       
        return $this->decodeField('content',$name,$default);        
    }

    public function getExtra($name, $default = ''){
        return $this->decodeField('extras',$name,$default);        

    }

    public function prepareData($url){
        if(method_exists($this, 'addPreparedData')){
            $data = $this->addPreparedData();
        }
        $data['url'] = $url;
        
        if(isset($this->father_page_template)){
            $data['father'] = \App\Models\Page::where('template',$this->father_page_template)->first();
        }
        $item_name = (new \ReflectionClass($this))->getShortName();
        $item_name = strtolower($item_name);
        $data[$item_name] = $this;
        return $data;
    }

    public function getOpenButton()
    {
        return '<a class="btn btn-sm btn-link" href="'.$this->url.'" target="_blank">'.
            '<i class="la la-eye"></i> '.trans('admin.view').'</a>';
    }

}
