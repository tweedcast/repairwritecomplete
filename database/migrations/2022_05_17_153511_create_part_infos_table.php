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
        Schema::create('part_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('line_id');
            $table->string('part_type');
            $table->string('part_type_desc');
            $table->string('line_desc_modifier')->nullable();
            $table->string('part_num')->nullable();
            $table->string('oem_part_num')->nullable();
            $table->string('part_price');
            $table->string('unit_part_price');
            $table->boolean('taxable')->default(1);
            $table->boolean('price_judgement_ind')->default(0);
            $table->boolean('alternate_part_ind')->default(0);
            $table->string('non_oem_part_num')->nullable();
            $table->boolean('price_adjustment')->default(0);
            $table->string('adjustment_pct')->nullable();
            $table->boolean('glass_part_ind')->default(0);
            $table->boolean('price_incl_ind')->default(0);
            $table->string('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_infos');
    }
};
