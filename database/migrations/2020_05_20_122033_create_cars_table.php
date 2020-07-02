<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('manufacture_year');
            $table->text('valuation');
            $table->text('body_code');
            $table->text('body_color');
            $table->text('interior_code');
            $table->text('engine_code');
            $table->text('gearbox_type');
            $table->text('gearbox_code');
            $table->text('status');
            $table->text('image');
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
        Schema::dropIfExists('cars');
    }
}
