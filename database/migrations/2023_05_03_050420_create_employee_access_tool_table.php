<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAccessToolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_access_tool', function (Blueprint $table) {
            $table->id();
            $table->string('tool', 255);
            $table->boolean('status')->default(true);
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_access_tool');
    }
}
