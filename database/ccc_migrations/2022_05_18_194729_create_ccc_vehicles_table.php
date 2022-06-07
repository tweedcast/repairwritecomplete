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
        Schema::connection('mysql2')->create('ccc_vehicles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('v_year');
            $table->string('make_code');
            $table->string('model_code');
            $table->string('bd_type_code');
            $table->string('engine_code');
            $table->string('vehicle_type');
            $table->string('std_veh_opt_code');
            $table->string('value_code');
            $table->string('ccc_ref_id');
            $table->string('v_year_make');
            $table->string('v_year_make_vt');
            $table->string('v_year_make_eng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ccc_vehicles');
    }
};
