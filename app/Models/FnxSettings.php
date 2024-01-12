<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class FnxSettings extends Model
{
    use CrudTrait;
    use HasTranslations;

    protected $table = 'fnx_settings';
    protected $guarded = ['id'];
    public $translatable = ['content'];
    protected $fakeColumns = ['extras','content'];
    
    private function decodeField($field, $name, $default = ''){
        if(isset($this->$field)){
            $json = json_decode($this->$field);
            if(isset($json->$name)){
                if(is_array($json->$name)){
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


    public function getContent($name, $default = ''){       
        return $this->decodeField('content',$name,$default);        
    }

    public function getExtra($name, $default = ''){
        return $this->decodeField('extras',$name,$default);        

    }
}
