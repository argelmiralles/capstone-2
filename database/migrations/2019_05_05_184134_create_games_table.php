<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->decimal('price', 10,2);
            $table->string('img_path');
            $table->unsignedBigInteger("category_id");
            $table->string('published_by')->nullable();
            $table->string('developed_by')->nullable();
            $table->unsignedBigInteger("quantityTotal");
            $table->unsignedBigInteger("quantityInStock");
            $table->unsignedBigInteger("quantityOnRent")->default(0);
            $table->unsignedBigInteger("releaseYear")->nullable();
            $table->string('review')->nullable();

            $table->timestamps();

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
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
        Schema::dropIfExists('games');
    }
}
