<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromRealEstateRealEstateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estate_real_estate_category', function (Blueprint $table) {
            $table->dropColumn('updated_at');
            $table->dropColumn('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estate_real_estate_category', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}
