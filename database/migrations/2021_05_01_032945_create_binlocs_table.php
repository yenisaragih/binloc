<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinlocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binlocs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part_number');
            $table->string('description');
            $table->string('stock_oh_s79');
            $table->string('stock_code_s79');
            $table->string('ip_prestocking');
            $table->string('stock_oh_s38');
            $table->string('stock_code_s38');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binlocs');
    }
}
