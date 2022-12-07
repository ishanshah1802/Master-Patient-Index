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
        Schema::create('tbl_generate_bills', function (Blueprint $table) {
            $table->unsignedInteger('bill_id')->autoIncrement();
            $table->unsignedInteger('patient_id');
            $table->foreign('patient_id')->references('patient_id')->on('tbl_patient_masters');
            $table->unsignedInteger('appointment_id');
            $table->foreign('appointment_id')->references('appointment_id')->on('tbl_schedule_appointments');
            $table->float('consulting_fees', 10)->default(0.00);
            $table->timestamps();
            $table->boolean('bill_status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_generate_bills');
    }
};
