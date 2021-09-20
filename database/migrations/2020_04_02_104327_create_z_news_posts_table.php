<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZNewsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_news_types', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();
            $table->smallInteger("order_no")->nullable();

            $table->unsignedBigInteger("parent_id")->index()->nullable();
            $table->foreign("parent_id")->references("id")->on("z_news_types")->onDelete("cascade");

            $table->timestamps();
        });

        Schema::create('z_news_type_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_news_type_id")->index()->nullable();
            $table->foreign("z_news_type_id")->references("id")->on("z_news_types")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_news_type_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("slug", 255)->index()->nullable();
            $table->string("image", 255)->nullable();
            $table->string("banner_image", 255)->nullable();

            $table->string("meta_title", 100)->nullable();
            $table->string("meta_keywords", 500)->nullable();
            $table->string("meta_description", 500)->nullable();

        });

        Schema::create('z_news_posts', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->boolean("featured1_flg")->nullable();
            $table->boolean("featured2_flg")->nullable();

            $table->timestamps();
        });

        Schema::create('z_news_post_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_news_post_id")->index()->nullable();
            $table->foreign("z_news_post_id")->references("id")->on("z_news_posts")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_news_post_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("slug", 255)->index()->nullable();
            $table->string("image", 255)->nullable();
            $table->string("featured1_image", 255)->nullable();
            $table->string("featured2_image", 255)->nullable();
            $table->string("excerpt", 2000)->nullable();
            $table->longText("content")->nullable();

            $table->string("meta_title", 100)->nullable();
            $table->string("meta_keywords", 500)->nullable();
            $table->string("meta_description", 500)->nullable();

        });

        Schema::create('z_news_post_types', function (Blueprint $table) {
            $table->unsignedBigInteger("z_news_post_id")->index();
            $table->foreign("z_news_post_id")->references("id")->on("z_news_posts")->onDelete("cascade");
            $table->unsignedBigInteger("z_news_type_id")->index();
            $table->foreign("z_news_type_id")->references("id")->on("z_news_types")->onDelete("cascade");

            $table->primary(["z_news_post_id", "z_news_type_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_news_post_types');
        Schema::dropIfExists('z_news_post_translations');
        Schema::dropIfExists('z_news_posts');
        Schema::dropIfExists('z_news_type_translations');
        Schema::dropIfExists('z_news_types');
    }
}
