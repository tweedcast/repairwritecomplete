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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('unqfile_id');
            $table->string('ro_id')->nullable();
            $table->string('est_system');
            $table->string('supp_no');
            $table->string('create_dt');
            $table->string('create_tm');
            $table->string('ins_co_nm');
            $table->string('clm_no');
            $table->string('ownr_ln');
            $table->string('ownr_fn');
            $table->string('rf_co_nm');
            $table->string('v_vin');
            $table->string('v_prod_dt')->nullable();
            $table->string('v_model_yr');
            $table->string('v_makecode')->nullable();
            $table->string('v_makedesc');
            $table->string('v_model');
            $table->string('v_mileage')->nullable();
            $table->string('v_color')->nullable();
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('user_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
};
