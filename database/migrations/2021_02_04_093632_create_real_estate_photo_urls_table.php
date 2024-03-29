<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatePhotoUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_photo_urls', function (Blueprint $table) {
            $table->id();

            $table->string('url')->nullable();
            $table->foreignId('real_estate_id');

            $table->foreign('real_estate_id')->references('id')->on('real_estates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_photo_urls');
    }
}
