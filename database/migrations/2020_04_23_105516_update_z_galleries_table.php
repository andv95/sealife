<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_gallery_translations', function (Blueprint $table) {
            $table->dropColumn(["image", "image_mobile", "video_url", "video_mobile_url"]);
            $table->longText("images")->nullable();
            $table->longText("images_mobile")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_gallery_translations', function (Blueprint $table) {
            $table->string("image", 255)->nullable();
            $table->string("image_mobile", 255)->nullable();
            $table->string("video_url", 255)->nullable();
            $table->string("video_mobile_url", 255)->nullable();

            $table->dropColumn(["images", "images_mobile"]);
        });
    }
}
