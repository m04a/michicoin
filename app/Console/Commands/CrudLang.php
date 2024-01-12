<?php

namespace App\Console\Commands;

use Artisan;
use File;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudLang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fnx7:crud-lang {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a CRUD interface: Controller, Model, Request with MultiLang support NO URLS';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $lowerName = strtolower($this->argument('name'));

        $plural = Str::plural($lowerName);

        $table_schema = 'title:json, priority:integer, active:integer, content:json:nullable, extras:json:nullable';

        // Create migration demo file
        Artisan::call('make:migration:schema create_'.$plural.'_table --model=0 --schema="'.$table_schema.'"');
        echo Artisan::output();

        // Create the CRUD Controller and show output
        Artisan::call('fnx7:crud-controller-lang', ['name' => $name]);
        echo Artisan::output();

        // Create the CRUD Model and show output
        Artisan::call('fnx7:crud-model-lang', ['name' => $name]);
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
            'code' => "\n<li class='nav-item'><a class='nav-link' href='{{ backpack_url('".$lowerName."') }}'><i class='nav-icon la la-question'></i> {{__('template.".Str::plural($name)."')}}</a></li>",
        ]);
        echo Artisan::output();
        


    }
}
