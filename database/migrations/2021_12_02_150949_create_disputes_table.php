<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisputesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disputes', function (Blueprint $table) {
            $table->id();
            $table->integer('from');
            $table->integer('to');
            $table->string('project_id');
            $table->string('type');
            $table->longText('req_evidence_detail');
            $table->longText('req_solution_detail');
            $table->string('file');
            $table->integer('freelancer_offer_amt')->default(null);
            $table->integer('client_offer_amt')->default(null);
            $table->integer('milestone_id');
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
        Schema::dropIfExists('disputes');
    }
}
