<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class AdminController extends Controller
{
    //
    public function clearmedia(){
        $file = new Filesystem;
        $file->cleanDirectory(public_path('imagecache'));
        \Alert::add('success',  __('admin.media_cache_cleared'))->flash();
        return back();
    }   
}
