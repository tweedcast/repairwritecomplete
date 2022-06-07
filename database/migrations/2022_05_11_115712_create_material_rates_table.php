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
        Schema::create('material_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('repair_id');
            $table->string('matl_type');
            $table->string('matl_desc');
            $table->integer('matl_rate');
            $table->boolean('taxable')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_rates');
    }
};
