<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 150);
            $table->string('text', 255);
            $table->string('icon', 100);
            $table->unsignedInteger('feature_id');
            $table->foreign('feature_id')->references('id')->on('features');
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
        Schema::dropIfExists('feature_items');
    }
}
