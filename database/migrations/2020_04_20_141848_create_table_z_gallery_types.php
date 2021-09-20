<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableZGalleryTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_gallery_types', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->unsignedInteger("parent_id")->nullable();
            $table->unsignedInteger("order_no")->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_gallery_type_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_gallery_type_id")->index()->nullable();
            $table->foreign("z_gallery_type_id")->references("id")->on("z_gallery_types")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_gallery_type_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("slug", 255)->nullable();

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
        Schema::dropIfExists('z_gallery_type_translations');
        Schema::dropIfExists('z_gallery_types');
    }
}
