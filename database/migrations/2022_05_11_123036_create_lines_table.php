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
        Schema::create('lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('repair_id');
            $table->integer('line_no');
            $table->string('line_ind');
            $table->integer('unq_seq');
            $table->string('line_desc');
            $table->string('part_type')->nullable();
            $table->boolean('part_des_j');
            $table->string('oem_partno');
            $table->float('act_price');
            $table->boolean('price_j');
            $table->integer('part_qty');
            $table->string('mod_lbr_ty');
            $table->float('mod_lb_hrs');
            $table->boolean('lbr_inc');
            $table->string('lbr_op');
            $table->boolean('lbr_hrs_j');
            $table->boolean('lbr_type_j');
            $table->boolean('lbr_op_j');
            $table->float('misc_amt');
            $table->boolean('misc_sublt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lines');
    }
};
