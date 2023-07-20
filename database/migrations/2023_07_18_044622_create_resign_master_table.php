<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResignMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resign_master', function (Blueprint $table) {
            $table->id();
            $table->unsignedbiginteger('employee_id');
            $table->unsignedbiginteger('approval_status_id');
            $table->string('checked_by', 255)->nullable();
            $table->string('author_by', 255)->nullable();
            $table->string('rejected_reason', 255)->nullable();
            $table->string('cb', 255)->nullable();
            $table->timestamp('cd')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('ub', 255)->nullable();
            $table->timestamp('ud')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('employee_id')->references('id')->on('employee');
            $table->foreign('approval_status_id')->references('id')->on('approval_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resign_master');
    }
}
