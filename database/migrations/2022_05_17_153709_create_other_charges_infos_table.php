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
        Schema::create('other_charges_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('line_id');
            $table->string('other_charges_type');
            $table->string('other_charges_type_desc')->nullable();
            $table->string('price')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('quantity')->nullable();
            $table->boolean('price_incl_ind')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_charges_infos');
    }
};
