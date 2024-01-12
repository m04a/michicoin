<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactSendRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ContactSend;
/**
 * Class ContactSendCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactSendCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
   // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
   // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ContactSend::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contact-send');
        CRUD::setEntityNameStrings(__('admin.contact_send'),__('admin.contact_sends'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addButtonFromModelFunction('top', 'readall', 'readAll', 'start');

        CRUD::column('readed')->type('boolean')->label(__('admin.readed'));
        CRUD::column('form')->type('text')->label(__('admin.form'));
        CRUD::column('name')->type('text')->label(__('admin.name'));
        CRUD::column('email')->type('text')->label(__('admin.email'));
        CRUD::column('created_at')->type('date')->label(__('admin.created_at'));
    }

    protected function setupShowOperation()
    {
        $entry = $this->crud->getCurrentEntry();
        if($entry){
            $entry->readed  =1;
            $entry->save();
        }
        $this->crud->set('show.setFromDb', false);
        CRUD::column('form')->type('text')->label(__('admin.form'));
        CRUD::column('name')->type('text')->label(__('admin.name'));
        CRUD::column('email')->type('text')->label(__('admin.email'));
        CRUD::column('data')->type('model_function')->function_name('showData')->label(__('admin.data'));
        CRUD::column('created_at')->type('date')->label(__('admin.created_at'));
    }

    public function Readall(){
        ContactSend::where('readed',0)->update(['readed'=>1]);
        \Alert::add('info',__('admin.all_mark_readed'));
        return back();
    }
   
}
