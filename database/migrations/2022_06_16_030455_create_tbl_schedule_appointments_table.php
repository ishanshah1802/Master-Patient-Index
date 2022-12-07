<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_schedule_appointments', function (Blueprint $table) {
            $table->unsignedInteger('appointment_id')->autoIncrement();
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('tbl_patient_masters');
            $table->date('current_date');
            $table->string('patient_age',3);
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string("medical_dept", 50);
            $table->string("symptoms", 255);
            $table->string("note", 255)->nullable();
            $table->timestamps();
            $table->boolean('appointment_status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_schedule_appointments');
    }
};
