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
        Schema::connection('mysql2')->create('ccc_smart_opts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('opt_id');
            $table->integer('opt_total');
            $table->longtext('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ccc_smart_opts');
    }
};
