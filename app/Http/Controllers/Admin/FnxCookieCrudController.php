<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FnxCookieRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Traits\CookiePositions;
use App\Http\Traits\CrudPermissions;

/**
 * Class FnxCookieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FnxCookieCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use CookiePositions;
    use CrudPermissions;

    public function setup()
    {
        $this->crud->setModel('App\Models\FnxCookie');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/fnxcookie');
        $this->crud->setEntityNameStrings(trans('admin.cookie'), trans('admin.cookies'));
        $this->setupPermissionActions('gdpr');

    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->addColumn('title');
        $this->crud->addColumn('category');

        $this->crud->addColumn('position');

    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(FnxCookieRequest::class);

        $this->crud->addField([
            'name' => 'title',
            'label' => trans('admin.title'),
            'type' => 'text'
        ]);


        $this->crud->addField([
            'name' => 'category_id',
            'label' => trans('admin.category'),
            'type' => 'select2',
            'entity'    => 'category', 
        ]);

        $positions =  [
            'none' => trans('admin.cookie_position_none'),
            'head' => trans('admin.cookie_position_head'),
            'body' => trans('admin.cookie_position_body'),
            'footer' => trans('admin.cookie_position_footer'),
        ];
        $positions = array_merge($positions,$this->cookie_positions());

        $this->crud->addField([
            'name' => 'position',
            'label' => trans('admin.cookie_position'),
            'type' => 'select_from_array',
            'options' => $positions,
            'allows_null' => false,
            'default' => 'none',
        ]);

        $this->crud->addField([
            'name' => 'script',
            'label' => trans('admin.cookie_script'),
            'type' => 'textarea',
            'placeholder' => trans('admin.cookie_script_placeholder')
        ]);
        
        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
