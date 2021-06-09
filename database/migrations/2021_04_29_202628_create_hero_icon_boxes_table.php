<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroIconBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_icon_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('alias', 100);
            $table->string('icon', 100);
            $table->foreignId('hero_main_id');
            $table->foreign('hero_main_id')->references('id')->on('hero_main');
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
        Schema::dropIfExists('hero_icon_boxes');
    }
}
