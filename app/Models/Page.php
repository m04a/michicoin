<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/* MULTIIDIOMA */
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

/* URLS de Michicoin, aixo ens afegeix la relació automàticament, l'attribut URL, la plantilla per defecte i el preparedData (que podem extendre amb addPreparedData)  */
use  App\Http\Traits\ModelUrl;

class Page extends Model
{
    use CrudTrait;
    use HasTranslations;
    use ModelUrl;   
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    public $translatable = ['title','content'];
    public $template_folder = 'pages';

    protected $fakeColumns = ['extras','content'];
    protected $templates = 'page_templates.php';


    public static function byTemplate($template){
        return self::with('fnx_url')->where('template', 'matching')->first();
    }
}