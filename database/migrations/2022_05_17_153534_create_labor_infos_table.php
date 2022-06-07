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
        Schema::create('labor_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('line_id');
            $table->string('labor_type');
            $table->string('labor_type_desc');
            $table->string('labor_flag')->nullable();
            $table->string('database_labor_type')->nullable();
            $table->string('database_labor_type_desc')->nullable();
            $table->string('labor_operation')->nullable();
            $table->string('labor_operation_desc')->nullable();
            $table->string('labor_oper_display')->nullable();
            $table->string('labor_hours')->nullable();
            $table->string('database_labor_hours')->nullable();
            $table->boolean('labor_incl_ind')->default(0);
            $table->string('labor_amt')->nullable();
            $table->boolean('taxable')->default(1);
            $table->boolean('labor_hours_judgement_ind')->default(0);
            $table->boolean('labor_type_judgement_ind')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labor_infos');
    }
};
