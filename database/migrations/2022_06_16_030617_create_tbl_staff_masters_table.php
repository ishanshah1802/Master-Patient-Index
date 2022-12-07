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
        Schema::create('tbl_staff_masters', function (Blueprint $table) {
            $table->unsignedInteger('staff_id')->autoIncrement();
            $table->string("staff_phone_number", 10);
            $table->string("staff_name", 50);
            $table->date('staff_dob');
            $table->string("staff_marital_status", 20);
            $table->string("staff_designation", 30);
            $table->string("staff_department", 30);
            $table->string("staff_blood_group", 5);
            $table->string("staff_gender", 10);
            $table->string("staff_email", 255)->nullable();
            $table->string("staff_address", 255);
            $table->string("staff_password", 255);
            $table->timestamps();
            $table->boolean('staff_status')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_staff_masters');
    }
};
