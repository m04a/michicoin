<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: use JSON data type for 'extras' instead of string
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template');
            $table->json('title')->nullable();
            $table->json('slug')->nullable();
            $table->json('content')->nullable();
            $table->text('extras')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        DB::table('pages')->insert(
            array(
                'id' =>1,
                'template' => 'home',
                'title' => json_encode([
                    'es' => 'Inicio',
                    'ca' => 'Inici',
                    'en' => 'Home'
                ])
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
