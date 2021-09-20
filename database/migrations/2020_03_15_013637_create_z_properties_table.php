<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_properties', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("home_flg")->default(false)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_property_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_property_id")->index()->nullable();
            $table->foreign("z_property_id")->references("id")->on("z_properties")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_property_id", "locale"]);

            $table->string("name", 50)->nullable();
            $table->string("slug", 50)->index()->nullable();
            $table->string("excerpt", 1000)->nullable();

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
        Schema::dropIfExists('z_property_translations');
        Schema::dropIfExists('z_properties');
    }
}
