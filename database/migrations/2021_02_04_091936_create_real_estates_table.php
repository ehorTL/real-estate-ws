<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->string('description');

            $table->double('price');
            $table->double('price_per_square_meter');
            $table->double('square');

            $table->string('address');
            $table->string('inner_id');
            $table->string('agent');
            $table->string('mobile_number');
            $table->string('email');

            $table->foreignId('real_estate_category_id');
            $table->foreign('real_estate_category_id')->references('id')->on('real_estate_categories');

            // TODO: default image link needed?
            $table->string('main_image_url')->nullable();

            $table->foreignId('contract_type_id');
            $table->foreign('contract_type_id')->references('id')->on('contract_types');

            $table->boolean('has_commision')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
}
