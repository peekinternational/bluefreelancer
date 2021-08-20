<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('main_category');
            $table->integer('sub_category');
            $table->string('title');
            $table->string('location');
            $table->string('skills');
            $table->string('description');
            $table->string('image');
            $table->integer('rate_status');
            $table->string('currency');
            $table->string('fixed_rate');
            $table->string('hourly_rate');
            $table->string('min_budget');
            $table->string('max_budget');
            $table->integer('status');
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
        Schema::dropIfExists('projects');
    }
}
