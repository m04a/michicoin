<?php

namespace App\Http\Traits;

trait SettingsTypes
{

    public function general(){
    //__('settings.general')
    //__('settings.desc_general')
//__('settings.general_logos')

        $this->addImage('general_logo',__('settings.general_logo'),'',FALSE);
        $this->addFake('general_homepage',__('settings.general_homepage'),'select_page');
        $this->addContent('general_sitename',__('settings.general_sitename'));
        $this->addFake('general_legal',__('settings.general_legal'),'select_page');

        $enabled_langs = config('backpack.crud.locales');


        $this->crud->addField([
            'fake' => true,
            'store_in' => 'extras',
            'name' => 'general_default_lang',
            'label' => __('settings.default_lang'),
            'type' => 'select_from_array',
            'allows_multiple' => false,
            'allows_null' => false,
            'default' => current($enabled_langs),
            'options' => $enabled_langs
        ]);
        
        $this->crud->addField([
            'fake' => true,
            'store_in' => 'extras',
            'name' => 'general_public_langs',
            'label' => __('settings.public_langs'),
            'type' => 'select2_from_array',
            'allows_multiple' => true,
            'allows_null' => false,
            'default' => array_keys($enabled_langs),
            'options' => $enabled_langs
        ]);


       
       

    }

    public function contact(){
    //__('settings.contact')
    //__('settings.desc_contact')


        $this->addFake('contact_email',__('settings.contact_email'));
        $this->addFake('contact_phone',__('settings.contact_phone'));
        $this->addFake('contact_address',__('settings.contact_address'),'textarea');
        $this->addRepetable('contact_networks',__('contact.social_networks'), [
            'image'=> __('contact.social_network_icon'),
            'link'=> __('contact.social_network_link')
        ]);
    }


    public function seo(){
    //__('settings.seo')
    //__('settings.desc_seo')
        $this->addFake('seo_robots',__('settings.seo_robots'),'textarea');
        $this->addFake('seo_ssl',__('settings.seo_ssl'),'checkbox');
        $this->addFake('seo_use_www',__('settings.seo_use_www'),'checkbox');        
    }
}