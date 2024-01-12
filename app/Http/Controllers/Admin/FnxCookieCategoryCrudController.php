<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FnxCookieCategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Traits\CrudPermissions;

/**
 * Class FnxCookieCategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FnxCookieCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use CrudPermissions;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\FnxCookieCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/fnxcookiecategory');
        CRUD::setEntityNameStrings('fnxcookiecategory', 'fnx_cookie_categories');
        $this->setupPermissionActions('gdpr');

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        $this->crud->addColumn('title');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FnxCookieCategoryRequest::class);

        $this->crud->addField([
            'name' => 'title',
            'label' => trans('admin.title'),
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'description',
            'label' => trans('admin.description'),
            'type' => 'textarea'
        ]);

        $this->crud->addField([
            'name' => 'provider',
            'label' => trans('admin.cookie_provider'),
            'type' => 'text'
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
