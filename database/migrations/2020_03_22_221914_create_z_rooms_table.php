<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_rooms', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->unsignedInteger("max_guest_no")->nullable();

            $table->boolean("active_flg")->default(true)->nullable();
            $table->unsignedBigInteger("z_cruise_id")->index()->nullable();
            $table->foreign("z_cruise_id")->references("id")->on("z_cruises")->onDelete("cascade");

            $table->timestamps();
        });

        Schema::create('z_room_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_room_id")->index()->nullable();
            $table->foreign("z_room_id")->references("id")->on("z_rooms")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_room_id", "locale"]);

            $table->string("name", 50)->nullable();
            $table->string("slug", 50)->index()->nullable();
            $table->text("key_facts")->nullable();
            $table->string("image", 255)->nullable();
            $table->text("images")->nullable();
            $table->string("size", 50)->nullable();
            $table->unsignedFloat("price")->nullable();
            $table->string("price_unit", 20)->nullable();

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
        Schema::dropIfExists('z_room_translations');
        Schema::dropIfExists('z_rooms');
    }
}
