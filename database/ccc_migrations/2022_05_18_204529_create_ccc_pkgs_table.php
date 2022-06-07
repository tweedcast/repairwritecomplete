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
        Schema::connection('mysql2')->create('ccc_pkgs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('package_id');
            $table->string('package_name');
            $table->integer('opts_total');
            $table->string('inc_opts')->nullable();
            $table->string('req_opts')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ccc_pkgs');
    }
};
