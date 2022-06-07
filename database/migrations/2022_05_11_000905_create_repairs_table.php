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
            $table->string('unqfile_id')->nullable();
            $table->string('document_id');
            $table->string('document_ver_code');
            $table->string('document_ver_code_desc');
            $table->string('document_ver_num');
            $table->string('document_status');
            $table->string('document_status_desc');
            $table->string('ins_company_name')->nullable();
            $table->string('ownr_fn');
            $table->string('ownr_ln');
            $table->string('ownr_address_1')->nullable();
            $table->string('ownr_address_2')->nullable();
            $table->string('ownr_city')->nullable();
            $table->string('ownr_state')->nullable();
            $table->string('ownr_zip')->nullable();
            $table->string('ownr_phone')->nullable();
            $table->string('estimator_fn')->nullable();
            $table->string('estimator_ln')->nullable();
            $table->string('rf_name')->nullable();
            $table->string('rf_id')->nullable();
            $table->string('rf_address_1')->nullable();
            $table->string('rf_address_2')->nullable();
            $table->string('rf_city')->nullable();
            $table->string('rf_state')->nullable();
            $table->string('rf_zip')->nullable();
            $table->string('rf_phone')->nullable();
            $table->string('ro_id')->nullable();
            $table->string('est_system');
            $table->string('v_vin');
            $table->string('v_prod_dt')->nullable();
            $table->string('v_model_yr');
            $table->string('v_makecode')->nullable();
            $table->string('v_makedesc');
            $table->string('v_model');
            $table->string('v_mileage')->nullable(); //RepairEvent
            $table->string('v_style')->nullable();
            $table->string('v_color')->nullable();
            $table->string('clm_no')->nullable();
            $table->unsignedInteger('location_id');
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
