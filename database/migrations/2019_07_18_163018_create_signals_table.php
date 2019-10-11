<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('data');
            $table->enum('status', ['ignored','success', 'failed'])->default('ignored');
            $table->boolean('valid')->default(true);
            $table->integer('ratio')->default(0);
            $table->timestamp('exec_time')->nullable();
            $table->enum('exec_type', ['system','test'])->default('system');
            $table->softDeletes();
            $table->unsignedBigInteger('scanner_id');
            $table->foreign('scanner_id')->references('id')->on('scanners');
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
        Schema::dropIfExists('signals');
    }
}
