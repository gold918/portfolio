<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimonial_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('photo', 100);
            $table->string('position', 150);
            $table->text('review');
            $table->unsignedInteger('testimonial_id');
            $table->foreign('testimonial_id')->references('id')->on('testimonials');
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
        Schema::dropIfExists('testimonial_items');
    }
}
