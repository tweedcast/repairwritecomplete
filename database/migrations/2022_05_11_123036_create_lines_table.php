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
        Schema::create('lines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('repair_id');
            $table->string('line_num');
            $table->boolean('is_header')->default(0);
            $table->boolean('is_child')->default(0);
            $table->string('unique_sequence_num');
            $table->string('estimate_ver_code')->nullable();
            $table->string('estimate_ver_desc')->nullable();
            $table->boolean('manual_line_ind')->default(0);
            $table->string('line_status_code')->nullable();
            $table->string('line_status_desc')->nullable();
            $table->string('line_desc');
            $table->boolean('desc_judgement_ind')->default(0);
            $table->longtext('line_memo')->nullable();
            $table->boolean('is_sublet')->default(0);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lines');
    }
};
