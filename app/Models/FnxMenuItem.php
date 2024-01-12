<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\FnxUrl;
class FnxMenuItem extends Model
{
     use HasTranslations;
     use CrudTrait;

     public $translatable = ['name','link'];
     protected $fillable = ['name', 'type', 'link', 'position', 'parent_id', 'extras','page_id'];

     public function fnx_url()
     {
        $locale = $this->locale;
        if(!$locale){
            $locale = \App::getLocale();
        }
        $fnx_url = FnxUrl::find($this->page_id);
        if($fnx_url && $fnx_url->locale==$locale){
            return $fnx_url;
        }
        elseif($fnx_url){
            return FnxUrl::where('model_id',$fnx_url->model_id)->where('model_class',$fnx_url->model_class)->where('locale',$locale)->first();
        }
        else return FALSE;
        
     }


     public function isActive($url){
        $curr = $url->full_url;
        if($curr==$this->url()){
            return true;
        }
        foreach($this->children as $ch){
           if($curr==$ch->url()){
               return true;
           }
        }
        return false;
    }
     
     public function getExtra($name, $default = ''){
        if(isset($this->extras)){
            $json = json_decode($this->extras);
            if(isset($json->$name)){
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

     public function parent()
     {
         return $this->belongsTo('app\Models\FnxMenuItem', 'parent_id')->orderBy('lft','asc');
     }
 
     public function children()
     {
         return $this->hasMany('app\Models\FnxMenuItem', 'parent_id')->orderBy('lft','asc');
     }

     public function url()
     {
         switch ($this->type) {
             case 'external_link':
                 return $this->link;
                 break;
 
             case 'internal_link':
                 return is_null($this->link) ? '#' : url($this->link);
                 break;
 
             case 'page_link': //page_link
                $fnx_url = $this->fnx_url();
                 if ($fnx_url) {
                     return $fnx_url->full_url;
                 }
                 break;
         }
     }

}
