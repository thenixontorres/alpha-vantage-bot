<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScannerStrategyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scanner_strategy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('scanner_id');
            $table->unsignedBigInteger('strategy_id');
            $table->foreign('scanner_id')->references('id')->on('scanners');
            $table->foreign('strategy_id')->references('id')->on('strategies');
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
        Schema::dropIfExists('scanner_strategy');
    }
}
