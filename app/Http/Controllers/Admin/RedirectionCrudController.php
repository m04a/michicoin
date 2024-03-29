<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RedirectionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RedirectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RedirectionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Redirection::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/redirection');
        CRUD::setEntityNameStrings('redirection', 'redirections');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::addColumn(['name' => 'from', 'label' => __('admin.from')]);
        CRUD::addColumn(['name' => 'to', 'label' => __('admin.to')]);
        CRUD::addColumn(['name' => 'type', 'label' => __('admin.type')]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RedirectionRequest::class);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
        CRUD::addField([
            'name' => 'from', 
            'label' => __('admin.from'),
            'hint'       => __('admin.from_hint'),
            'wrapper'   => [ 
                'class'      => 'form-group col-md-6'
             ],
        ]);
        CRUD::addField([
            'name' => 'to', 
            'label' => __('admin.to'),
            'hint'       => __('admin.to_hint'),
            'wrapper'   => [ 
                'class'      => 'form-group col-md-6'
             ],
        ]);
        CRUD::addField([
            'name' => 'type', 
            'type' => 'select_from_array', 
            'options' => [
                301 => __('admin.perman_redirect'), 
                302 => __('admin.temp_redirect')], 
            'label' => __('admin.type'),
            'wrapper'   => [ 
                'class'      => 'form-group col-md-3'
             ],
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
