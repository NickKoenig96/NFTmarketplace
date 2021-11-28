<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nfts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');

            $table->string('image_file_path')->default("defaultImage.png");
            $table->foreignId('creator_id');
            $table->foreignId('owner_id');
            $table->integer('price');
            $table->string('item_hash')->default("");
            $table->boolean('minted')->default(false);
            $table->boolean('forSale')->default(false);
            $table->foreignId('collection_id');
            $table->float('area');
            $table->string('object_type');
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
        Schema::dropIfExists('nfts');
    }
}
