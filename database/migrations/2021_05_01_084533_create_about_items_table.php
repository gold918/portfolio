<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_items', function (Blueprint $table) {
            $table->increments('id');
            $table->text('list_item');
            $table->unsignedInteger('about_id');
            $table->foreign('about_id')->references('id')->on('about');
            $table->set('status', ['publish', 'not published'])->default('not published');
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
        Schema::dropIfExists('about_items');
    }
}
