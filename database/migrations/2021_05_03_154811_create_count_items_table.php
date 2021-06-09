<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('count_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('main_word', 50);
            $table->string('text', 255);
            $table->string('icon', 100);
            $table->integer('number');
            $table->unsignedInteger('count_id');
            $table->foreign('count_id')->references('id')->on('counts');
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
        Schema::dropIfExists('count_items');
    }
}
