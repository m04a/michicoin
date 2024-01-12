<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FnxUrl extends Model
{
    
    public static function createUrl($locale, $url, $metas, $model_class, $model_id){
        
        $current = self::where('model_class',$model_class)
        ->where('model_id',$model_id)
        ->where('locale',$locale)
        ->first();

        $url_exist = self::where('url',$url)
                        ->where('locale',$locale)
                        ->first();
        
        if($url_exist){
            //ya existe este registro, miraremos si además es de otra url
            if($current && $current->id == $url_exist->id){
                //Somos nosotros mismos, no tocamos nada. 
                // No hace falta guardar la URL, pues no hay cambios (hemos encontrado el registro por slug i por model)
                //Guardamos solo METAS
                $current->meta_title = $metas['title'] ?? '';
                $current->meta_description = $metas['description'] ?? '';
                $current->meta_keywords = $metas['keywords'] ?? '';
                $current->save();

                return false;
            }
            //la url que pretendemos ocupar existe, por lo que debemos usar un slug diferente
            $url .= '-'.Str::random(5); 
        }

        if(!$current){
            $current = new self();
            $current->locale = $locale;
            $current->model_class = $model_class;
            $current->model_id = $model_id;
        }
        $current->url = $url;
        $current->meta_title = $metas['title'] ?? '';
        $current->meta_description = $metas['description'] ?? '';
        $current->meta_keywords = $metas['keywords'] ?? '';

        $current->save();
    }

    public function getFullUrlAttribute(){
        return url($this->locale.'/'.$this->url.'.html');
    }

    public function alternates($all=false){
        if($all){
            return self::where('model_id',$this->model_id)->where('model_class',$this->model_class)->get();
        }
        else{
            //solo publicos
            $public_langs = getSetting('general_public_langs');            
            return self::whereIn('locale',$public_langs)->where('model_id',$this->model_id)->where('model_class',$this->model_class)->get();
        }
        
    }
    public function alternate($locale){
        return self::where('model_id',$this->model_id)->where('model_class',$this->model_class)->where('locale',$locale)->first();
    }

    public function item(){
        return $this->belongsTo($this->model_class,'model_id');
    }
}
