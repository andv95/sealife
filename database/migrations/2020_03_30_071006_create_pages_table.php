<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->string("view_name", 255)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('page_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("page_id")->index()->nullable();
            $table->foreign("page_id")->references("id")->on("pages")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["page_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("slug", 255)->index()->nullable();
            $table->text("titles")->nullable()->comment("Lưu tất cả các titles có thể bằng json");
            $table->text("images")->nullable()->comment("Lưu tất cả các images có thể bằng json");
            $table->longText("contents")->nullable()->comment("Lưu tất cả các contents có thể bằng json");

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
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('pages');
    }
}
