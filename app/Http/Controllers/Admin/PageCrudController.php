<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use App\Http\Controllers\CrudUrlController; //Crud amb el suport per URLs de Michicoin
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Traits\CrudPermissions;
/**
 * Class PageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PageCrudController extends CrudUrlController
{
   // use \App\Http\Traits\PageTemplates;
      use CrudPermissions;

      public $templates = 'page_templates.php';

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Page::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/page');
        CRUD::setEntityNameStrings(__('template.page'), __('template.pages'));
        $this->setupPermissionActions('pages');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        parent::setupListOperation();

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
        CRUD::setValidation(PageRequest::class);

        parent::setupCreateOperation();
    }
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(PageRequest::class);

        parent::setupUpdateOperation();
    }

}