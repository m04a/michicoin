<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ContactSend extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'contactsends';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'data' => 'array',
    ];

    function showData(){
        $showed = ['name','email','name'];
        $html = '<ul>';
        foreach($this->data as $k=>$v){
            if(!in_array($k,$showed)){
                $html .= '<li><strong>'.$k.'</strong> '.$v.'</li>';
            }
            
        }
        $html .= '</ul>';
        return $html;
    }

    function readAll(){
        return '<a class="btn btn-primary" href="/admin/contact-send/readall">'.__('admin.read_all').'</a>';
    }
}
