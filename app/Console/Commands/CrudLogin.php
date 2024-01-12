<?php

namespace App\Console\Commands;

use Artisan;
use File;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class CrudLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fnx7:crud-login {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a CRUD object with login cappabilities';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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


        $table_schema = 'title:json, priority:integer, name:string:nullable, surname:string:nullable, email:string, password:string, reset_token:string:nullable, reset_valid:datetime:nullable, ';
    
        // Create migration demo file
        Artisan::call('make:migration:schema create_'.$plural.'_table --model=0 --schema="'.$table_schema.'"');
        echo Artisan::output();

                
        // Create the CRUD Model and show output
        Artisan::call('fnx7:crud-model-login', ['name' => $name]);
        echo Artisan::output();

        // Create the CRUD Controller and show output
        Artisan::call('fnx7:crud-controller-login', ['name' => $name]);
        echo Artisan::output();


        // Create the CRUD Controller and show output
        Artisan::call('fnx7:controller-login', ['name' => $name]);
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
            'code' => "\n<li class='nav-item'><a class='nav-link' href='{{ backpack_url('".$lowerName."') }}'><i class='nav-icon la la-users'></i> {{__('template.".Str::plural($name)."')}}</a></li>",
        ]);
        echo Artisan::output();
    }
}
