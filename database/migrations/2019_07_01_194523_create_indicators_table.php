<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateIndicatorsTable.
 */
class CreateIndicatorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('indicators', function(Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('function_name');
            $table->enum('interval', ['1min','5min','15min','30min','60min','daily','weekly','monthly'])->nullable();
            $table->integer('time_period')->nullable();
            $table->enum('series_type', ['close','open','high','low'])->nullable();
         	$table->enum('status', ['on','off'])->default('off');
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
		Schema::drop('indicators');
	}
}
