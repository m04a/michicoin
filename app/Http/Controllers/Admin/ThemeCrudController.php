<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ThemeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Theme;
use \App\Http\Traits\CrudHelpers;

/**
 * Class ThemeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ThemeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
   //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
  //  use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
  use CrudHelpers;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Theme::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/theme');
        CRUD::setEntityNameStrings(__('template.theme'), __('template.themes'));
    }

    public function getThemes(){
        $dir = resource_path('views/themes');
        $ffs = scandir($dir);   
        $themes = [];

        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..')  {
                if (is_readable($dir . '/' . $ff))  {
                    if (is_dir($dir . '/' . $ff))  {
                        $themes[] =  $ff;
                    }
                    }
            }
        }

        return $themes;
    }

    public function loadFields($theme='default'){
        $dir = resource_path('views/themes/'.$theme);
        include($dir.'/fields.php');
    }

    private function setDefaultTheme(){
       $default = request()->input('default');
       if($default){
        $other = Theme::where('default',1)->update(['default'=>0]);
       }
    }

    public function update()
    {
        $this->setDefaultTheme();
        $response = $this->traitUpdate();
        return $response;
    }

    public function store()
    {
        $this->setDefaultTheme();
        $response = $this->traitStore();
        return $response;

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'name', 'type' => 'text','label'=>__('template.title')]); 
        //$this->crud->removeButton('create');
        CRUD::addColumn(['name' => 'default', 'type' => 'check','label'=>__('template.default')]); 

        if(count($this->getThemes()) == Theme::count()){
            $this->crud->denyAccess('create');

        }
        

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ThemeRequest::class);
        $exists = Theme::pluck('name')->toArray();
        $folders = $this->getThemes();

        $missing = array_diff($folders, $exists);

        $theme =  current($missing);

        CRUD::addField([
            'name' => 'name', 
            'type' => 'text',
            'attributes' => ['readonly'=>'readonly'],
            'default' => $theme
        ]); 

        CRUD::addField([
            'name' => 'default', 
            'type' => 'checkbox',
            'label' => __('template.default_theme')
        ]); 

        $this->loadFields($theme);


        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $theme = $this->crud->getCurrentEntry()->name;

        CRUD::addField([
            'name' => 'default', 
            'type' => 'checkbox',
            'label' => __('template.default_theme')
        ]); 

        $this->loadFields($theme);
    }
}
