<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use App\Http\Traits\CrudPermissions;
use \App\Http\Traits\CrudHelpers;

class FnxMenuItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation { reorder as traitReorder; }
    use CrudPermissions;
    use CrudHelpers;

 	public function reorder()
    {

        $position = request()->input('p');

        // your custom code here
        $this->crud->query->where('position',$position);

       
        $positions = getMenuPositions();

        // set the default template
        if ($position == false) {
            $position = array_key_first($positions);
        }
        // actually use the template
        $deep = 2;
        if ($position) {
            $deep =  $positions[$position]['deep'] ?? 2;
        }

        if($deep!=2){
           $this->crud->enableReorder('name', $deep);
        }

        // call the method in the trait
        $request = $this->traitReorder();

        return $request;
    }
    private function checkFields(){
        if($this->crud->entry->name=='' && $this->crud->entry->type=='page_link' ){
            $url = \App\Models\FnxUrl::find($this->crud->entry->page_id);
            if($url && $url->meta_title!=''){
                $this->crud->entry->name = $url->meta_title;
                $this->crud->entry->save();
            }
        }
        
    }



    public function update()
    {
        $response = $this->traitUpdate();
        $this->checkFields();
        return $response;
    }

    public function store()
    {
        $response = $this->traitStore();
        $this->checkFields();
        return $response;
    }

    public function setup()
    {
        $this->setupPermissionActions('menus');

        $this->crud->setModel("App\Models\FnxMenuItem");

        $this->crud->setRoute(config('backpack.base.route_prefix').'/menu-item');
        $this->crud->setEntityNameStrings(trans('admin.menu_item'), trans('admin.menu'));

        $this->crud->enableReorder('name', 2);

        $this->crud->operation('list', function () {
            $this->crud->addColumn([
                'name' => 'name',
                'label' => 'Label',
            ]);
            $this->crud->addColumn([
                'name' => 'position',
                'label' => 'Position',
            ]);
            $this->crud->addColumn([
                'label' => 'Parent',
                'type' => 'select',
                'name' => 'parent_id',
                'entity' => 'parent',
                'attribute' => 'name'
            ]);

            $this->crud->removeButton('reorder');
            $this->crud->addButton('top', 'reorder', 'view', 'michicoin.buttons.menu_reorder', 'end');

            $positions = getMenuPositionsArray();


            $this->crud->addFilter([
                  'name' => 'position',
                  'type' => 'dropdown',
                  'label'=> 'Posición de menu'
                ], $positions, function($value) { // if the filter is active
                   $this->crud->addClause('where', 'position', $value);
                }); 

        });

        $this->crud->operation('create', function () {
            
            $positions = getMenuPositionsArray();

            $select_positions = [];

            foreach($positions as $pos){
                $select_positions[$pos] = $pos;
            }

            $this->crud->addField([
                'name' => 'position',
                'type' => 'select_from_array',
                'label' => 'Posición de menu',
                 'options' => $select_positions,
                 'allows_null' => false,
                 'default' => 1
            ]);
           $this->crud->addField([
                'name' => 'name',
                'type' => 'text',
                'label' => 'Etiqueta',
            ]);
           $this->crud->addField([
                'name' => ['type', 'link', 'page_id'],
                'type' => 'page_or_link'
            ]);

        });

        $this->crud->operation('update', function () {

            $positions = getMenuPositionsArray();
            $select_positions = [];

            foreach($positions as $pos){
                $select_positions[$pos] = $pos;
            }

            $this->crud->addField([
                'name' => 'position',
                'type' => 'select_from_array',
                'label' => 'Posición de menu',
                 'options' => $select_positions,
                 'allows_null' => false,
                 'default' => 1
            ]);


             $position = $this->crud->getCurrentEntry()->position;
             $positions = getMenuPositions();

             // set the default template
             if ($position == false) {
                 $position = array_key_first($positions);
             }
             // actually use the template
             $deep = 2;
             if ($position) {
                 $deep =  $positions[$position]['deep'] ?? 2;
             }

             if($deep!=2){
                $this->crud->enableReorder('name', $deep);
             }
             

             if($deep > 1){
                $this->crud->addField([
                    'label' => 'Padre',
                    'type' => 'select2',
                    'name' => 'parent_id',
                    'entity' => 'parent',
                    'attribute' => 'name',
                    'model' => "app\Models\FnxMenuItem"
                ]);
    
             }


             $this->crud->addField([
                'name' => 'name',
                'type' => 'text',
                'label' => 'Etiqueta',
            ]);
           $this->crud->addField([
                'name' => ['type', 'link', 'page_id'],
                'type' => 'page_or_link'
            ]);



             if ($position) {    
                $file_inc = $positions[$position]['include'] ?? '';
                $file_path = resource_path('views/themes/'.getTheme().'/admin/'.$file_inc);
                if($file_inc!='' && file_exists($file_path)){
                    include($file_path);
                }
               
            }

            
        });


    }

}
