<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments("id");

            $table->string("key", 20)->nullable();
            $table->string("display_name", 50)->nullable();
            $table->tinyInteger("type")->nullable();
            $table->string("group", 20)->nullable();
            $table->string("options", 500)->nullable();
            $table->text("value")->nullable();
            $table->smallInteger("order_no")->nullable();

            $table->boolean("language_flg")->nullable()->default(false);
        });

        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger("setting_id")->index()->nullable();
            $table->foreign("setting_id")->references("id")->on("settings")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["setting_id", "locale"]);

            $table->text("translated_value")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_translations');
        Schema::dropIfExists('settings');
    }
}
