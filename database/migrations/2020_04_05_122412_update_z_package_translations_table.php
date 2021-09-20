<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZPackageTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_package_translations', function (Blueprint $table) {
            $table->string("itinerary_file", 255)->nullable()->after("itinerary");
            $table->text("image")->nullable()->after("slug");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_package_translations', function (Blueprint $table) {
            $table->dropColumn("itinerary_file");
            $table->dropColumn("image");
        });
    }
}
