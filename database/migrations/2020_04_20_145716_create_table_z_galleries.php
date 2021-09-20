<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableZGalleries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_galleries', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->unsignedInteger("z_gallery_type_id")->nullable();
            $table->unsignedInteger("order_no")->nullable();

            $table->timestamps();
        });

        Schema::create('z_gallery_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_gallery_id")->index()->nullable();
            $table->foreign("z_gallery_id")->references("id")->on("z_galleries")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_gallery_id", "locale"]);

            $table->string("image", 255)->nullable();
            $table->string("image_mobile", 255)->nullable();
            $table->string("video_url", 255)->nullable();
            $table->string("video_mobile_url", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_gallery_translations');
        Schema::dropIfExists('z_galleries');
    }
}
