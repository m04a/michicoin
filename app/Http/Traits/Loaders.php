<?php

namespace App\Http\Traits;
use App\Models\FnxPage;
use Request;
use App\Models\Entry;
use App\Models\Page;
use Carbon\Carbon;

use Auth;
trait Loaders
{
    private function common($data){
        $data['legalpage'] = Page::with('fnx_url')->find(getSetting('general_legal'));
        $data['contactpage'] = Page::with('fnx_url')->where('template','contact')->first();
        return $data;
    }


    public function pages_home($data){      
        $data['blogpage'] = Page::with('fnx_url')->where('template','blog')->first();
        $data['entries'] = Entry::with('fnx_url')->where('published',1)->where('published_at','<=',date('YmdHis'))->orderBy('published_at','desc')->take(5)->get();
        return $data;
    }


    public function pages_blog($data){
        $data['entries'] = Entry::with('fnx_url')->where('published',1)->where('published_at','<=',date('YmdHis'))->orderBy('published_at','desc')->paginate(6);
        return $data;
    }

   

}