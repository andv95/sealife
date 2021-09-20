<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_banners', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("type_model_id")->index()->nullable();
            $table->string("type", 20)->index()->nullable();

            $table->string("global_name", 50)->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_banner_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_banner_id")->index()->nullable();
            $table->foreign("z_banner_id")->references("id")->on("z_banners")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_banner_id", "locale"]);

            $table->text("images")->nullable();
            $table->text("images_mobile")->nullable();
            $table->string("video_url", 255)->nullable();
            $table->string("video_url_mobile", 255)->nullable();
            $table->string("view_more_url", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_banner_translations');
        Schema::dropIfExists('z_banners');
    }
}
