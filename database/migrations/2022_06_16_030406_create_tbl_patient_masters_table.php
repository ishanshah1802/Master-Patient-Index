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
        Schema::create('tbl_patient_masters', function (Blueprint $table) {
            $table->unsignedInteger('patient_id')->autoIncrement();
            $table->string("patient_phone_number", 10);
            $table->string("patient_name", 50);
            $table->date('patient_dob');
            $table->string("patient_marital_status", 20);
            $table->string("patient_blood_group", 5);
            $table->string("patient_occupation", 50);
            $table->string("patient_gender", 10);
            $table->string("patient_height", 10);
            $table->string("patient_weight", 10);
            $table->string("patient_email", 255)->nullable();
            $table->string("patient_address", 255);
            $table->string("patient_password", 255);
            $table->string("guardian_name", 50);
            $table->string("guardian_relation", 20);
            $table->string("guardian_phone_number", 10);
            $table->timestamps();
            $table->boolean('patient_status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_patient_masters');
    }
};
