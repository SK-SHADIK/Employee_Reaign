<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeResignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_resign', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('employee_id');
            $table->unsignedbiginteger('employee_access_tool_id');
            $table->boolean('had_access')->default(false);
            $table->boolean('access_removed')->default(false);
            $table->string('remarks', 255)->nullable();
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('employee_id')->references('id')->on('employee');
            $table->foreign('employee_access_tool_id')->references('id')->on('employee_access_tool');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_resign');
    }
}
