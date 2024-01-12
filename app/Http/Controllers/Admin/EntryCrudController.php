<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudUrlController; //Crud amb el suport per URLs de Michicoin

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\EntryRequest;
use App\Http\Traits\CrudPermissions;

/**
 * Class EntryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EntryCrudController extends CrudUrlController
{
    use CrudPermissions;

    protected $page_slug = 'blog';
   

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Entry::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/entry');
        $this->crud->setEntityNameStrings(trans('admin.entry'), trans('admin.entries'));
        $this->setupPermissionActions('entries');

    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn('title');
        $this->crud->addColumn([
            'name' => 'published', // The db column name
            'label' => trans('template.publish'), // Table column heading
            'type' => 'check'
         ]);
        $this->crud->addColumn('published_at');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(EntryRequest::class);

        $this->crud->addField([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'url'
        ]);
        $this->crud->addField([
            'name' => 'metas',
            'type' => 'metatags',
            'tab' => trans('admin.metas'),
            'attribute' => 'meta_title'
        ]);

        $this->crud->addField([  
            'name' => 'published_at',
            'label' => trans('template.published_at'),
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm'
            ],
            'allows_null' => false,
            'tab' => trans('template.publish')
        ]);

        $this->crud->addField([  
            'name' => 'published',
            'label' => trans('template.published'),
            'type' => 'checkbox',
            'tab' => trans('template.publish')
        ]);

        $this->crud->addField([
            'name' => 'image',
            'label' => trans('template.image'),
            'type' => 'browse_image',
            'fake' => true,
            'store_in' => 'extras',
            'tab' => trans('template.media')
        ]);

        $this->crud->addField([
            'name' => 'title',
            'label' => trans('template.title'),
            'type' => 'text',
            'placeholder' => trans('template.title_placeholder'),
            'tab' => trans('template.content')
        ]);

        $this->crud->addField([
            'name' => 'resume',
            'label' => trans('template.resume'),
            'type' => 'textarea',
            'placeholder' => trans('template.resume_placeholder'),
            'tab' => trans('template.content')
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => trans('template.content'),
            'type' => 'wysiwyg',
            'tab' => trans('template.content')
        ]);

        $this->crud->addField([
            'name' => 'image',
            'label' => trans('template.image'),
            'type' => 'browse_image',
            'fake' => true,
            'store_in' => 'extras',
            'tab' => trans('template.media')
        ]);

        $this->crud->addField([
            'name' => 'ytvideo',
            'label' => trans('template.ytvideo'),
            'type' => 'text',
            'fake' => true,
            'store_in' => 'extras',
            'tab' => trans('template.media')
        ]);

        $this->crud->addField([
            'name' => 'gallery',
            'defaul' => [],
            'fake' => true,
            'store_in' => 'extras',
            'type' => 'repeatable',
            'fields' => [
                [
                    'name' => 'image',
                    'type' => 'browse_image',
                    'label' => trans('template.image'),
                ]       
            ],     
            'tab' => trans('template.media')
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
