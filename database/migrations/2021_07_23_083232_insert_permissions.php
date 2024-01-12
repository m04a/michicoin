<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'users',
                'guard_name' => 'web'
            ],
            [
                'name' => 'settings',
                'guard_name' => 'web'
            ],
            [
                'name' => 'translates',
                'guard_name' => 'web'
            ],
            [
                'name' => 'list pages',
                'guard_name' => 'web'
            ],
            [
                'name' => 'list entries',
                'guard_name' => 'web'
            ],
            [
                'name' => 'list menus',
                'guard_name' => 'web'
            ],
            [
                'name' => 'list gdpr',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update pages',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update entries',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update menus',
                'guard_name' => 'web'
            ],
            [
                'name' => 'update gdpr',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete pages',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete entries',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete menus',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete gdpr',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create pages',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create entries',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create menus',
                'guard_name' => 'web'
            ],
            [
                'name' => 'create gdpr',
                'guard_name' => 'web'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->delete();
    }
}
