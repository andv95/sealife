<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_reviews', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("home_flg")->default(false)->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_review_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_review_id")->index()->nullable();
            $table->foreign("z_review_id")->references("id")->on("z_reviews")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_review_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("author", 50)->nullable();
            $table->unsignedInteger("rating")->nullable();
            $table->date("review_date")->nullable();
            $table->string("image", 255)->nullable();
            $table->text("content")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_review_translations');
        Schema::dropIfExists('z_reviews');
    }
}
