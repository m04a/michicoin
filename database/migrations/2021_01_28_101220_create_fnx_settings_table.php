<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFnxSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fnx_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->json('extras')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });

        DB::table('fnx_settings')->insert(
            array(
                'key' => 'general',
                'extras' => json_encode([
                    'general_homepage' => 1
                ])
            )
        );
        DB::table('fnx_settings')->insert(
            array(
                'key' => 'contact'
            )
        );
        DB::table('fnx_settings')->insert(
            array(
                'key' => 'seo'
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
        Schema::dropIfExists('fnx_settings');
    }
}
