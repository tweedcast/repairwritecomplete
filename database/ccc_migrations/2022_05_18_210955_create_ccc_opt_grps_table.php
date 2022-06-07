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
        Schema::connection('mysql2')->create('ccc_opt_grps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('grp_id');
            $table->string('hdr_id');
            $table->string('group_code');
            $table->string('description');
            $table->integer('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ccc_opt_grps');
    }
};
