<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['on', 'off'])->default('on');
            $table->enum('type_request', ['strategy', 'strict'])->default('strict');
            $table->enum('strict_time_request', ['1min', '5min', '15min', '30min','60min', 'daily','weekly','monthly'])->default('60min');
            
            $table->string('alpha_vantage_key');
            $table->string('notifications_mail');
            $table->softDeletes();
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
        Schema::dropIfExists('settings');
    }
}
