<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_destinations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_destination_id")->index()->nullable();
            $table->foreign("z_destination_id")->references("id")->on("z_destinations")->onDelete("cascade");

            $table->string("global_name", 50)->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_destination_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_destination_id")->index()->nullable();
            $table->foreign("z_destination_id")->references("id")->on("z_destinations")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_destination_id", "locale"]);

            $table->string("name", 50)->nullable();
            $table->string("slug", 50)->index()->nullable();
            $table->string("image", 255)->nullable();
            $table->text("images")->nullable();
            $table->text("summary")->nullable();
            $table->text("description")->nullable();

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
        Schema::dropIfExists('z_destination_translations');
        Schema::dropIfExists('z_destinations');
    }
}
