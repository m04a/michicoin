<?php

namespace App\Console\Commands;

use Artisan;
use File;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fnx7:crud-url  {name} {--with-categories}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a CRUD interface: Controller, Model, Request with URLs';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $withCats = $this->option('with-categories');

        $lowerName = strtolower($this->argument('name'));

        $plural = Str::plural($lowerName);

        $path = resource_path('views/themes/default/public/'.$plural);
        File::makeDirectory($path);

        $view_content = "@extends('themes.default.public.layouts.base')\n@section('content')\n\n@endsection";
        File::put($path.'/'.$lowerName.'.blade.php', $view_content);

        if($withCats){
            $namecat = $name.'Cat';
            $view_content = "@extends('themes.default.public.layouts.base')\n@section('content')\n@foreach(\$".$lowerName."cat->childrens as \$item)\n@endforeach\n@endsection";
            File::put($path.'/category.blade.php', $view_content);


            $table_schema = 'title:json, priority:integer, active:boolean, father_id:integer:nullable, content:json, extras:json';
            // Create migration demo file
            Artisan::call('make:migration:schema create_'.$plural.'_table --model=0 --schema="'.$table_schema.'"');
            echo Artisan::output();

            $table_schema = 'title:json, priority:integer,  content:json, extras:json';
            // Create migration demo file
            Artisan::call('make:migration:schema create_'.$plural.'_categories_table --model=0 --schema="'.$table_schema.'"');
            echo Artisan::output();


            // Create the CRUD Controller and show output
            Artisan::call('fnx7:crud-controller-url-wcat', ['name' => $name]);
            echo Artisan::output();

            // Create the CRUD Model and show output
            Artisan::call('fnx7:crud-model-url-wcat', ['name' => $name]);
            echo Artisan::output();

            // Create the CRUD Controller and show output
            Artisan::call('fnx7:crud-controller-url', ['name' => $namecat]);
            echo Artisan::output();

            // Create the CRUD Model and show output
            Artisan::call('fnx7:crud-model-url-cat', ['name' => $name]);
            echo Artisan::output();

    
            // Create the CRUD Request and show output
            Artisan::call('backpack:crud-request', ['name' => $name]);
            echo Artisan::output();

            Artisan::call('backpack:crud-request', ['name' => $namecat]);
            echo Artisan::output();
    
            // Create the CRUD route
            Artisan::call('backpack:add-custom-route', [
                'code' => "Route::crud('".$lowerName."', '".$name."CrudController');",
            ]);
            echo Artisan::output();

            // Create the CRUD route
            Artisan::call('backpack:add-custom-route', [
                'code' => "Route::crud('".strtolower($namecat)."', '".$namecat."CrudController');",
            ]);
            echo Artisan::output();
    
            $html_block = '<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-box"></i> {{__("template.'.strtolower(Str::plural($name)).'")}}</a>';
            $html_block .= '<ul class="nav-dropdown-items">';
            $html_block .= "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('".strtolower($namecat)."') }}'><i class='nav-icon la la-tag'></i> {{__('template.categories')}}</a></li>";
            $html_block .= "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('".$lowerName."') }}'><i class='nav-icon la la-box'></i> {{__('template.".strtolower(Str::plural($name))."')}}</a></li>";
            $html_block .= '</ul></li>';

            // Create the sidebar item
            Artisan::call('backpack:add-sidebar-content', [
                'code' => $html_block,
            ]);
            echo Artisan::output();
        }
        else{

            $table_schema = 'title:json, priority:integer, content:json, extras:json';
    
            // Create migration demo file
            Artisan::call('make:migration:schema create_'.$plural.'_table --model=0 --schema="'.$table_schema.'"');
            echo Artisan::output();
    
    
    
            // Create the CRUD Controller and show output
            Artisan::call('fnx7:crud-controller-url', ['name' => $name]);
            echo Artisan::output();
    
            // Create the CRUD Model and show output
            Artisan::call('fnx7:crud-model-url', ['name' => $name]);
            echo Artisan::output();
    
            // Create the CRUD Request and show output
            Artisan::call('backpack:crud-request', ['name' => $name]);
            echo Artisan::output();
    
            // Create the CRUD route
            Artisan::call('backpack:add-custom-route', [
                'code' => "Route::crud('".$lowerName."', '".$name."CrudController');",
            ]);
            echo Artisan::output();
    
            // Create the sidebar item
            Artisan::call('backpack:add-sidebar-content', [
                'code' => "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('".$lowerName."') }}'><i class='nav-icon la la-question'></i> {{__('template.".Str::plural($name)."')}}</a></li>",
            ]);
            echo Artisan::output();
        }


    }
}
