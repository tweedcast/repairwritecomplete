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
        Schema::connection('mysql2')->create('ccc_options', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('opt_id');
            $table->string('grp_id');
            $table->string('option_code');
            $table->string('description');
            $table->integer('group');
            $table->integer('mutual_exclusive_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ccc_options');
    }
};
