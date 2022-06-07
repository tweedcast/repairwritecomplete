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
        Schema::create('subtotals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('repair_id');
            $table->string('ttl_type');
            $table->string('ttl_desc');
            $table->float('t_amt');
            $table->float('t_hrs')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtotals');
    }
};
