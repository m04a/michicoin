<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('default')->default(0);
            $table->json('extras')->nullable();
            $table->json('content')->nullable();

            $table->timestamps();
        });


        DB::table('themes')->insert(
            array(
                'name' => 'default',
                'default' => 1
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
        Schema::dropIfExists('themes');
    }
}
