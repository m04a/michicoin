<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminEmailController extends Controller
{
    //
    public function config(){
        return view('michicoin.email.config');

    }

    public function save(Request $request){

        put_permanent_env('MAIL_MAILER',$request->get('mail_mailer'));
        put_permanent_env('MAIL_HOST',$request->get('mail_host'));
        put_permanent_env('MAIL_PORT',$request->get('mail_port'));
        put_permanent_env('MAIL_USERNAME',$request->get('mail_username'),true);
        put_permanent_env('MAIL_PASSWORD',$request->get('mail_password'),true);
        put_permanent_env('MAIL_ENCRYPTION',$request->get('mail_encryption'));
        put_permanent_env('MAIL_FROM_ADDRESS',$request->get('mail_from_address'));
        put_permanent_env('MAIL_FROM_NAME',$request->get('mail_from_name'),true);


        \Alert::add('primary', __('translate.email_cfg_saved'))->flash();;

        return redirect(backpack_url('email/config'));
    }

    public function test(Request $request){
        try{
            $to = $request->mail_test;
            Mail::to($to)->send(new \App\Mail\Contact([], __('admin.test_mail')));
            \Alert::add('primary', __('translate.email_sended'))->flash();;

        }
        catch(\Exception $e){
            \Alert::add('danger', __('translate.email_not_sended'))->flash();;
            session()->flash('error_test',$e->getMessage());

        }

        return redirect()->back();
    }
}
