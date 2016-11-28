<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('date_of_visit');
            $table->string('hour_of_visit', 5);
            $table->decimal('price')->default(0);
            $table->string('diagnosis', 30)->default("Zdychaj dziadu");
            $table->string('type', 30);
            $table->bigInteger('doctor_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('patient_id')->references('id')->on('patients');
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
        Schema::dropIfExists('visits');
    }
}
