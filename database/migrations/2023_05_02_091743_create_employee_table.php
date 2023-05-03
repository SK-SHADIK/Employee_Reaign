<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->nullable();
            $table->string('emp_name', 255)->nullable();
            $table->integer('emp_dept')->nullable();
            $table->string('designation', 255)->nullable();
            $table->integer('status')->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('email_office', 255)->nullable();
            $table->string('email_personal', 255)->nullable();
            $table->string('phone_office', 255)->nullable();
            $table->string('phone_personal', 255)->nullable();
            $table->string('blood_group', 255)->nullable();
            $table->string('qualification', 255)->nullable();
            $table->string('license_no', 255)->nullable();
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('eventcard', 255)->nullable();
            $table->string('emp_upi', 255)->nullable();
            $table->date('emp_conf_date')->nullable();
            $table->date('emp_resign_date')->nullable();
            $table->string('gender', 255)->nullable();
            $table->date('internship_start_date')->nullable();
            $table->date('internship_end_date')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
}
