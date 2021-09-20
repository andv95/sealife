<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_posts', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->unsignedSmallInteger("type")->index()->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_post_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_post_id")->index()->nullable();
            $table->foreign("z_post_id")->references("id")->on("z_posts")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_post_id", "locale"]);

            $table->string("name", 50)->nullable();
            $table->string("slug", 50)->index()->nullable();
            $table->string("excerpt", 1000)->nullable();
            $table->string("image", 255)->nullable();
            $table->text("images")->nullable();
            $table->longText("description")->nullable();

            $table->string("meta_title", 100)->nullable();
            $table->string("meta_keywords", 500)->nullable();
            $table->string("meta_description", 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_post_translations');
        Schema::dropIfExists('z_posts');
    }
}
