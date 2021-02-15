<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRealEstates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->foreignId('created_by_user_id')->nullable();
            $table->foreignId('modified_by_user_id')->nullable();

            $table->foreign('created_by_user_id')->references('id')->on('real_estates')->onDelete('set null');
            $table->foreign('modified_by_user_id')->references('id')->on('real_estates')->onDelete('set null');

            $table->boolean('realized')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->dropColumn("realized");
            $table->dropForeign('real_estates_created_by_user_id_foreign');
            $table->dropForeign('real_estates_modified_by_user_id_foreign');
            $table->dropColumn("created_by_user_id");
            $table->dropColumn("modified_by_user_id");
        });
    }
}
