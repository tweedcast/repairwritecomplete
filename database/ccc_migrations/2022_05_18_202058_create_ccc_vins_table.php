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
        Schema::connection('mysql2')->create('ccc_vins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vin_prefix');
            $table->string('vin_suffix');
            $table->string('ccc_sv_id');
            $table->string('cccrefid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ccc_vins');
    }
};
