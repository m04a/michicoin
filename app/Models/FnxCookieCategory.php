<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class FnxCookieCategory extends Model
{
    use CrudTrait;
    use HasTranslations;
    public $translatable = ['title','description'];
   

    protected $table = 'fnx_cookie_categories';

    protected $guarded = ['id'];
   
}
