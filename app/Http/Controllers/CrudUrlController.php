<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Models\Page;
use App\Models\FnxUrl;
use Illuminate\Support\Str;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \App\Http\Traits\CrudHelpers;

class CrudUrlController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use CrudHelpers;

    private function storeUrl(){

        $locale = request()->input('_locale',\App::getLocale());

        $model_class = get_class($this->crud->getModel());
        $model_id = $this->crud->entry->id;
        $slug = $this->crud->entry->slug;

        request()->validate(['title'=>'required']);
        
        $metas = request()->input('metas');

        if($metas['title']==''){
            $metas['title'] = request()->input('title');
        }


        $req_all = request()->all();
        foreach(request()->all() as $k=>$v){
            if(Str::startsWith($k,'rfake_')){
                $new_gals = json_decode($v,TRUE);
                if($v!='' && is_array($new_gals)){
                    $parts = explode('_',$k);
                    $real_field = $parts[1];
                    $deco_content = json_decode($this->crud->entry->content);
                    $deco_extras = json_decode($this->crud->entry->extras);
    
                    if(isset($deco_content->$real_field)){
                        $decoded = json_decode($deco_content->$real_field,TRUE);
                        $field = 'content';                        
                    }

                    foreach($new_gals as $ng){
                        $newitem['image'] = $ng;
                        $decoded[] = $newitem;
                    }

                    if($field=='content'){
                        $deco_content->$real_field = $decoded;
                        $this->crud->entry->content = $deco_content;
                        $this->crud->entry->save();
                    }
    
                  
                }
               
            }
        }


        //Convertimos a formato slug
        $slug =  Str::slug($this->crud->entry->title);
        $father = false;

        if(method_exists($model_class,'father')){
            //ens diu que existeix dins el model una funció father, que ha de ser la relació amb un altre objecte
            $father = $this->crud->entry->father;
            if($father){
                $father->locale = $locale;
            }
            if($father && isset($father->fnx_url->url)){
                //resulta que existeix :D
                $slug = $father->fnx_url->url.'/'.$slug;
            }
        }
        elseif(!$father && isset($this->page_slug) && $this->page_slug!=''){
            //Su padre es una pàgina
            $parent_slug = $this->page_slug;
            $parent_page = Page::where('template',$parent_slug)->first();
            if($parent_page){
                $parent_url = FnxUrl::where('locale',$locale)->where('model_class','App\Models\Page')->where('model_id',$parent_page->id)->first();
                if($parent_url){
                    $parent_slug = $parent_url->url;
                }                
            }
            $slug = $parent_slug.'/'.$slug;
        }

        FnxUrl::createUrl($locale, $slug, $metas, $model_class, $model_id);
    }
    public function update()
    {
        $response = $this->traitUpdate();
        $this->storeUrl();
        return $response;
    }

    public function store()
    {
        $response = $this->traitStore();
        $this->storeUrl();
        return $response;

    }
    public function destroy($id)
    {
        $model_class = get_class($this->crud->getModel());
        $entry = $model_class::find($id);
        if($entry && $entry->fnx_url){
            $entry->fnx_url->delete();
        }
        $this->crud->hasAccessOrFail('delete');
        return $this->crud->delete($id);
    }

    protected function setupListOperation(){
        $this->crud->addColumn([
            'name' => 'title',
            'label' => __('template.title')
        ]);
        if(isset($this->templates)){
            $this->crud->addColumn([
                'name' => 'template_name',
                'type' => 'text',
                'label' => __('template.template')
            ]);
        }

        $this->crud->addButtonFromModelFunction('line', 'open', 'getOpenButton', 'beginning');

    }
    

    protected function setupCreateOperation(){
        //Si ens han dit que hi ha un Crud de Plantilles el fem servir
        if(isset($this->templates)){
            $this->crud->addField([
                'name' => 'template',
                'label' => trans('admin.template'),
                'type' => 'select_page_template',
                'options' => $this->getTemplatesArray(),
                'value' =>  \Request::input('template'),
                'allows_null' => false,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ]);
        }

        $this->crud->addField([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'url'
        ]);

        
        $this->crud->addField([
            'name' => 'title',
            'label' => trans('template.title'),
            'type' => 'text',
            'placeholder' => trans('template.title_placeholder'),
            'tab' => trans('template.content')
        ]);

        if(isset($this->templates)){
            $template = \Request::input('template');
            $this->useTemplate($template);
        }


        $this->crud->addField([
            'name' => 'metas',
            'type' => 'metatags',
            'tab' => trans('admin.metas'),
            'attribute' => 'meta_title'
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
      
          //Si ens han dit que hi ha un Crud de Plantilles el fem servir
          if(isset($this->templates)){
            $this->crud->addField([
                'name' => 'template',
                'label' => trans('pagemanager.template'),
                'type' => 'select_page_template',
                'options' => $this->getTemplatesArray(),
                'value' =>  \Request::input('template'),
                'allows_null' => false,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ]);
        

        $this->crud->addField([
            'name' => 'url',
            'label' => 'URL',
            'type' => 'url'
        ]);



        
        $this->crud->addField([
            'name' => 'title',
            'label' => trans('template.title'),
            'type' => 'text',
            'placeholder' => trans('template.title_placeholder'),
            'tab' => trans('template.content')
        ]);

  
            $template = \Request::input('template') ?? $this->crud->getCurrentEntry()->template;

            $this->useTemplate($template);

         $this->crud->addField([
                'name' => 'metas',
                'type' => 'metatags',
                'tab' => trans('admin.metas'),
                'attribute' => 'meta_title'
            ]);
        }
        else{
            $this->setupCreateOperation();
        }
      
    }

    /**
     * Add the fields defined for a specific template.
     *
     * @param  string $template_name The name of the template that should be used in the current form.
     */
    public function useTemplate($template_name = false)
    {
        $templates = $this->getTemplates();

        // set the default template
        if ($template_name == false) {
            $template_name = array_key_first($templates);
        }
        // actually use the template
        if ($template_name) {
            $file_inc = $templates[$template_name]['include'] ?? '';
            $file_path = resource_path('views/themes/'.getTheme().'/admin/'.$file_inc);
            if($file_inc!='' && file_exists($file_path)){
                include($file_path);
            }
           
        }
    }


     /**
     * Get all defined templates.
     */
    public function getTemplates($template_name = false)
    {
        
        include(resource_path('views/themes/'.getTheme().'/'.$this->templates));

        if (! count($templates)) {
            abort(503, trans('admin.template_not_found'));
        }

        return $templates;
    }

    /**
     * Get all defined template as an array.
     *
     * Used to populate the template dropdown in the create/update forms.
     */
    public function getTemplatesArray()
    {
        $templates = $this->getTemplates();

        foreach ($templates as $tname=>$template) {
            $templates_array[$tname] = $template['label'] ?? $tname;
        }

        return $templates_array;
    }

}
