<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RealEstateRealEstateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_real_estate_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('real_estate_id');
            $table->foreignId('real_estate_category_id');

            $table->foreign('real_estate_id')->references('id')->on('real_estates')
                ->onDelete('cascade');
            $table->foreign('real_estate_category_id')->references('id')->on('real_estate_categories')
                ->onDelete('cascade');

            $table->unique(['real_estate_id', 'real_estate_category_id'], 'rsrec_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_real_estate_category');
    }
}
