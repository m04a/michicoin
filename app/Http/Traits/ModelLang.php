<?php

namespace App\Http\Traits;

trait ModelLang
{
    private function decodeField($field, $name, $default = ''){
        if(isset($this->$field)){
            $json = json_decode($this->$field);
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
}