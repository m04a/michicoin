<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class FnxCookie extends Model
{
    use CrudTrait;
   
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'fnx_cookies';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $hidden = [];
    
    public function category(){
        return $this->belongsTo('App\Models\FnxCookieCategory');
    }

    public static function scripts($position){
        $scripts = '';

        foreach(self::where('position',$position)->get() as $cookie){
            if(\Session::has('Fnx_Cookies_'.$cookie->category_id)){
                $scripts .= "\n".$cookie->script;
            }
        }
        
        return $scripts;
    }
}
