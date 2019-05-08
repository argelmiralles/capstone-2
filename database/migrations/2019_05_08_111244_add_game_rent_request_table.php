<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGameRentRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_rent_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rent_request_id');
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('week');
            $table->timestamps();

            $table->foreign('game_id')
            ->references('id')
            ->on('games')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('rent_request_id')
            ->references('id')
            ->on('rent_requests')
            ->onDelete('restrict')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_request');
    }
}
