<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPopularKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_popular_keys', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_popular_key_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_popular_key_id")->index()->nullable();
            $table->foreign("z_popular_key_id")->references("id")->on("z_popular_keys")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_popular_key_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("url", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_popular_key_translations');
        Schema::dropIfExists('z_popular_keys');
    }
}
