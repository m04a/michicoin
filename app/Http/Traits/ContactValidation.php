<?php

namespace App\Http\Traits;

trait ContactValidation
{

    /*
        Definim el comportament dels formularos amb les funcions form_<FORM> i form_post_<FORM>
        La primera s'executa abans de enviar/validar el formulari. Es obligatori que exiteixi. La segona es el que passa dp de enviar correctament i abans del retorn/redirecció

        Que HEM re detornar dins el form els diferents elements en la primera funcio?

        rules: OBLIGATORI. Regles de validacio de laravel
        to:  Destinatari del email. En cas de no definir-ho va al generic Config::get('settings.email')
        subject: Assumpte del mail
        rd: Redireccio després d'enviar el mail
        not_send: Quins camps no cal que s'enviin per correu
        fname: array. Els leys son els camps del formulari i els values les seves traduccions.
        error. Si volem podem retornar error si no passem alguna validacio
        replaces. Substituim el camp d'entrada per algun camp formatat
            per RECAPTCHA RECORDA POSAR  {!! RecaptchaV3::field('contact') !!}

    */
    private function form_contact()
    {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'comments' => 'required',
            'accept_conditions' => 'required',
          //  'g-recaptcha-response' => 'required|recaptchav3:contact,0.5'
        ];

        $form['rules'] = $rules;

        $not_send = [
            'accept_conditions'
        ];

        $form['not_send'] = $not_send;
        $form['to'] = 'marcos@michicoin.com';
        //$form['attachments'] = [\Request::file('photos')];
        //$form['replaces]['name'] = 'paco';

        $form['fname'] = [
            'name' => __('public.full_name'),
            'phone' => __('public.phone'),
            'email' => __('public.email'),
            'comments' => __('public.comments'),
        ];

        return $form;
    }

  

}