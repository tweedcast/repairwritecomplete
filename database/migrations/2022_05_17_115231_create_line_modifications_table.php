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
        Schema::create('line_modifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('line_id');
            $table->string('type');
            $table->string('value');
            $table->string('doc_code');
            $table->string('doc_ver');
            $table->string('line_ver');
            $table->boolean('added')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('line_modifications');
    }
};
