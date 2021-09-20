<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50)->index()->nullable();
            $table->boolean("active_flg")->default(true)->nullable();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->unsignedInteger("order")->nullable();

            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('cascade');
        });

        Schema::create('menu_item_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("menu_item_id")->index()->nullable();
            $table->foreign("menu_item_id")->references("id")->on("menu_items")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["menu_item_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("url", 255)->nullable();
            $table->string("open_target", 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_item_translations');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');
    }
}
