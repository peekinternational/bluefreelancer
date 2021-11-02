<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->integer('from');
            $table->integer('to');
            $table->integer('type');
            $table->string('professionalism');
            $table->string('communication');
            $table->string('payment');
            $table->string('clarity_spec');
            $table->string('emp');
            $table->integer('on_time');
            $table->integer('on_budget');
            $table->string('comments');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('feedback');
    }
}
