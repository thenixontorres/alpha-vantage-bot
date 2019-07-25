<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scanners', function (Blueprint $table) {
          	$table->bigIncrements('id');
            $table->longText('settings')->nullable();
            $table->enum('scanner_type', ['physical','digital','stock_market'])->default('stock_market');
            $table->enum('interval', ['1min', '5min', '15min', '30min','60min', 'daily','weekly','monthly'])->default('60min');
            $table->unsignedBigInteger('asset_id'); 
            $table->unsignedBigInteger('asset_to_id')->nullable(); 
            $table->enum('status', ['on','off'])->default('off');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->foreign('asset_to_id')->references('id')->on('assets');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
