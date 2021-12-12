<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Favourites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id')->unsigned();
            // // $table->integer('nft_id')->unsigned();
            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId('nft_id')
                ->references('id')
                ->on('nfts')
                ->onDelete('cascade');
            $table->boolean('sentiment')->default(false);
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
        //
    }
}
