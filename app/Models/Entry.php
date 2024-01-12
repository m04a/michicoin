<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/* MULTIIDIOMA */
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

/* URLS de Michicoin, aixo ens afegeix la relació automàticament, l'attribut URL, la plantilla per defecte i el preparedData (que podem extendre amb addPreparedData)  */
use  App\Http\Traits\ModelUrl;

class Entry extends Model
{
    use CrudTrait;
    use HasTranslations;
    use ModelUrl;   

    protected $table = 'entries';
    protected $guarded = ['id'];
    public $translatable = ['title','resume','content'];
    protected $dates = ['published_at'];
    /* Nom de la carpeta per les vistes d'aqeust tipus */
    public $template_folder = 'entries';
    public $father_page_template = 'blog';

    /* nom del element en singular. Servirà per tenir a la vista el $TEMPLATE i, si no tenim plantilles, sera la per  */
    public $template = 'entry';
    protected $fakeColumns = ['extras'];


}
