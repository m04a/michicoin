<?php

namespace App\Http\Traits;

trait CrudHelpers
{

    private $fieldDefaults = [];

    private function getIconDefinition(){        
        $def = [
            //CSS per explorar, modificable en cada projecte (POT SER UN CDN)
            // 'css' => url('vendor/fontawesome-free/css/all.min.css'),
            'css' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css',
            'find_class' => '.bi-',
            'show_class' => 'bi bi-'
        ];
        return $def;
    }

    /*
    |--------------------------------------------------------------------------
    | HELPERS: Cambiar valors per defecte
    |--------------------------------------------------------------------------
    */

    private function setTab($tab){
        $this->fieldDefaults['tab'] = $tab;
    }

    private function clearTab(){
        $this->fieldDefaults['tab'] = '';
    }



  /*
    |--------------------------------------------------------------------------
    | HELPERS: Per afegir camps comuns
    |--------------------------------------------------------------------------
    */
    // Afegir una imatge, que sempre guardem al extras
    // Ex. $this->addImage('image');
    private function addImage($name, $label= '', $tab='', $hint= '', $dark=false, $store_in='extras'){
        if($label==''){
            $label = __('template.image');
        }
        $atts = [
            'name' => $name,
            'fake' => TRUE,
            'store_in' => $store_in,
            'type' => 'browse_image',
            'hint' => $hint,
            'label' => $label
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }

        if($dark){
            $atts['wrapper']['class'] = 'form-group col-md-12 bg-dark py-3';
        }

        $this->crud->addField($atts);

        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            $atts['type'] = 'image';
            $atts['width'] = '250px';
            $atts['height'] = 'auto';
            $this->crud->addColumn($atts);
        }
    }




    private function addCheck($name, $label, $tab=''){

        $atts = [
            'name' => $name,
            'label' => $label,
            'type' => 'checkbox',
            'fake' => true,
            'store_in' => 'extras'
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }

        $this->crud->addField($atts);

        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            $attfields['type'] = 'check';
            $this->crud->addColumn($atts);
        }
    }


    private function addRelation($name, $label, $options, $tab=''){

        $atts = [
            'name' => $name,
            'label' => $label,
            'type' => 'select_from_array',
            'options' => $options,
            'fake' => true,
            'store_in' => 'extras'
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }

        $this->crud->addField($atts);

        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            $attfields['type'] = 'check';
            $this->crud->addColumn($atts);
        }
    }

    // Afegir un contingut traduible, que sempre guardem al content. 
    // En aquest cas el label es OBLIGATORI. Podem afegir textareas o cketitors nomes modificant el type
    // Ex. $this->addContent('subtitle',__('template.subtitle'),'textarea');
    private function addContent($name,$label, $type='text', $tab=''){
        if($label==''){
            $label = __('template.image');
        }
        $atts = [
            'name' => $name,
            'label' => $label,
            'fake' => TRUE,
            'store_in' => 'content',
            'type' => $type
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }
        if($type=='ckeditor'){
            //disable embed
           // $atts['extra_plugins'] = ['justify'];
            $atts['options'] = [
                'autoGrow_minHeight'   => 200,
                'autoGrow_bottomSpace' => 50,
                'removePlugins'        => 'resize,maximize,embed',
                'extraPlugins' => 'justify',
            ];
        }

        $this->crud->addField($atts);


        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            $this->crud->addColumn($atts);
        }
    }


    private function addFake($name,$label, $type='text', $tab='', $otherAtts=[]){
        if($label==''){
            $label = __('template.image');
        }
        $atts = [
            'name' => $name,
            'label' => $label,
            'fake' => TRUE,
            'store_in' => 'extras',
            'type' => $type
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }

        foreach($otherAtts as $k=>$v){
            $atts[$k] = $v;
        }

        $this->crud->addField($atts);

        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            if($type=='checkbox'){
                $atts['type'] = 'check';

            }
            $this->crud->addColumn($atts);
        }
    }

    //Afegir un camp tipus select_from_array. Es guarda sempre als EXTRAS
    //Ex. $this->addSelect('theme',$options)
    private function addSelect($name, $options, $label='', $tab=''){
        if($label==''){
            $label = __('template.options');
        }

        $atts = [
            'name' => $name,
            'fake' => TRUE,
            'store_in' => 'extras',
            'type' => 'select_from_array', 
            'options' => $options,
            'allows_null' => false,
            'label' => $label           
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }


        $this->crud->addField($atts);

        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            $atts['type'] = 'text';
            $this->crud->addColumn($atts);
        }

    }

    // Afegir un icone extret de una llibreria CSS. Es guarda sempre al EXTRAS.
    // Ex. $this->addIcon('icon');
    private function addIcon($name, $label= '', $tab=''){
        if($label==''){
            $label = __('template.icon');
        }
        
        $def = $this->getIconDefinition();

        $atts = [
            'name' => $name,
            'fake' => TRUE,
            'store_in' => 'extras',
            'type' => 'icon_picker', 
            'css' => $def['css'],
            'find_class' => $def['find_class'],
            'show_class' => $def['show_class'],
        ];
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts['tab'] = $tab;
        }


        $this->crud->addField($atts);
    }

    // Afegir un checkbox per indicar si una secció es o no visible. el TAB es obligatori ja que ho farem per TABS. El label sera sempre el mateix
    // Ex. $this->addEnableSection('section_enable',__('template.section'));
    private function addEnableSection($name,$tab=''){
        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }
        if($tab!=''){
            $atts = [
                'fake' => TRUE,
                'type' => 'checkbox',
                'store_in' => 'extras',
                'tab' => $tab,
                'name' => $name,
                'label' => __('template.enable_section')
            ];
            $this->crud->addField($atts);
        }
       
    }

    // Afegir un camp de repeticio. Els FIELDS han de ser NOM_CAMP=>LABEL
    // Ex. $this->addRepetable('gallery',__('template.gallery'),FIELDS,TRUE);

    private function addRepetable($name,$label, $fields, $translatable=FALSE , $tab='', $multiple_image = FALSE){
        //Per defecte els camps son de text sempre, si volem cambiar el tipus cal definir al inici de la key (nom del camp)
        //els atributs diferents. Per.ex. image_bg, image_main o image son 3 camps diferents de tipus image. Pots afegir tipus propis

        if($tab==''){
            $tab =  $this->fieldDefaults['tab'] ?? '';
        }

        $def = $this->getIconDefinition();

        $fieldTypes = [
            'desc' =>  [
                'type' => 'textarea'
            ],
            'id' =>  [
                'type' => 'id'
            ],
            'image' => [
                'type' => 'browse_image'
            ],
            'imagedark' => [
                'type' => 'browse_image',
                'wrapper' => ['class' => 'form-group col-md-12 bg-dark py-3'],
            ],
            'num' => [
                'type' => 'number'
            ],
            'icon' => [
                    'type' => 'icon_picker',
                    'css' => $def['css'],
                    'find_class' => $def['find_class'],
                    'show_class' => $def['show_class'],
                    'wrapper' => ['class' => 'form-group col-md-4'],
            ],
            'posx' => [
                'type' => 'select_from_array',
                'allows_null' => false,
                'wrapper' => ['class' => 'form-group col-md-4'],
                'options' => ['justify-content-start text-start'=>__('template.left'),'justify-content-center text-center'=>__('template.center'),'justify-content-end text-end'=>__('template.right')]
            ],
            'posy' => [
                'type' => 'select_from_array',
                'allows_null' => false,
                'wrapper' => ['class' => 'form-group col-md-4'],
                'options' => ['align-items-start'=>__('template.top'),'align-items-center'=>__('template.middle'),'align-items-end'=>__('template.bottom')]
            ]
        ];
        $atts = [
            'fake' => TRUE,
            'type' => 'repeatable',
            'default' => [],
            'name' => $name,
            'label' => $label            
        ];


        if($multiple_image){
            $matts = [
                'name' => 'rfake_'.$name,
                'fake' => TRUE,
                'label' => trans('template.add_images').' '.$label,
                'type' => 'browse_image_multiple',
                'multiple'   => true,
                'hint' => __('template.add_images_hint'),
                'mime_types' => 'image'
            ];
            if($tab!=''){
                $matts['tab'] = $tab;
            }
            $this->crud->addField($matts);
        }

        $att_fields = [];
        foreach($fields as $field=>$flabel){
            $parts = explode('_',$field);
            $lparts = explode('::',$flabel);
            if(isset($fieldTypes[$parts[0]])){
                //no es tipo normal
                $attfield = $fieldTypes[$parts[0]];
                $attfield['name'] = $field;
                $attfield['label'] = $lparts[0];   
                if(isset($lparts[1])){
                    $attfield['hint'] = $lparts[1];             
                }
                
                $att_fields[] = $attfield;
            }
            else{
                $att_fields[] = [
                    'name'    => $field,
                    'type'    => 'text',
                    'label'   => $lparts[0],
                    'wrapper' => ['class' => 'form-group col-md-4'],
                    'hint' => $lparts[1] ?? ''
                ];
                
            }
        }

        $atts['fields'] = $att_fields;

        if($tab!=''){
            $atts['tab'] = $tab;
        }

        if($translatable){
            $atts['store_in'] = 'content';
        }
        else{
            $atts['store_in'] = 'extras';
        }

        $this->crud->addField($atts);

        if(isset($this->crudHelperColumns) && $this->crudHelperColumns){
            $this->crud->addColumn($atts);
        }
    }

}