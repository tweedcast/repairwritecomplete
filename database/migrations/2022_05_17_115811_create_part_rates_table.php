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
        Schema::create('part_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('repair_id');
            $table->string('part_type');
            $table->string('adj_type');
            $table->integer('adj_pct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_rates');
    }
};
