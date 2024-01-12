<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFnxUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fnx_urls', function (Blueprint $table) {
            $table->id();
            $table->string('locale',10);
            $table->string('url');
            $table->string('model_class');
            $table->integer('model_id');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->text('meta_keywords');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fnx_urls');
    }
}
