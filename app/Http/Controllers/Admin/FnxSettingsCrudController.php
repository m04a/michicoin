<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FnxSettingsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Http\Traits\SettingsTypes;
use \App\Http\Traits\CrudHelpers;
use App\Http\Traits\CrudPermissions;

/**
 * Class FnxSettingsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FnxSettingsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
  //  use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use SettingsTypes;
    use CrudHelpers;
    use CrudPermissions;

    protected $crudHelperColumns = TRUE;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\FnxSettings::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/fnxsettings');
        CRUD::setEntityNameStrings(__('settings.setting'), __('settings.settings'));
        CRUD::setListView('michicoin.admin.settings');
        $this->setupPermissionActions('settings');

        if(!backpack_user()->root){
            //nomes el root pot crear
            $this->crud->denyAccess('create');
        }


    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //$this->crud->addColumn('key');

       // $template = $this->crud->getCurrentEntry()->key;


        $this->useAllTemplates();

        if(!env('ALLOW_CREATE_SETTINGS',TRUE)){
            $this->crud->removeButton('create');
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
        CRUD::setValidation(FnxSettingsRequest::class);

        $this->crud->addField([
            'name' => 'key',
            'label' => trans('admin.template'),
            'type' => 'select_page_template',
            'options' => $this->getTemplatesArray(),
            'value' =>  \Request::input('template'),
            'allows_null' => false
        ]);

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
        $template = $this->crud->getCurrentEntry()->key;

        $this->useTemplate($template);
    }

    protected function setupShowOperation()
    {
        $template = $this->crud->getCurrentEntry()->key;

        $this->crud->addColumn('key');

        $this->useTemplate($template);
    }

    public function useTemplate($template_name = false)
    {
        $templates = $this->getTemplates();

        // set the default template
        if ($template_name == false) {
            $template_name = $templates[0]->name;
        }
        // actually use the template
        if ($template_name) {
            $this->{$template_name}();
        }
    }

    public function useAllTemplates()
    {
        $templates = $this->getTemplatesArray();

        foreach($templates as $template){
            $this->{$template}();
        }

    }


    public function getTemplates($template_name = false)
    {
        $templates_array = [];

        $templates_trait = new \ReflectionClass('\App\Http\Traits\SettingsTypes');
        $templates = $templates_trait->getMethods(\ReflectionMethod::IS_PUBLIC);

        if (! count($templates)) {
            abort(503, trans('admin.template_not_found'));
        }

        return $templates;
    }

    public function getTemplatesArray()
    {
        $templates = $this->getTemplates();

        foreach ($templates as $template) {
            $templates_array[$template->name] = $template->name;
        }

        return $templates_array;
    }
}
