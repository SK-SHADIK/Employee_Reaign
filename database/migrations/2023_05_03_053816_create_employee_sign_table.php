<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_sign', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('employee_id');
            $table->text('employee_sign');
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('employee_id')->references('id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_sign');
    }
}
