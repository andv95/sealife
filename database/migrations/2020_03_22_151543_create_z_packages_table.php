<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_packages', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();

            $table->unsignedBigInteger("z_cruise_id")->index()->nullable();
            $table->foreign("z_cruise_id")->references("id")->on("z_cruises")->onDelete("cascade");
            $table->unsignedBigInteger("z_duration_id")->index()->nullable();
            $table->foreign("z_duration_id")->references("id")->on("z_durations")->onDelete("cascade");

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_package_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_package_id")->index()->nullable();
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_package_id", "locale"]);

            $table->string("name", 50)->nullable();
            $table->string("slug", 50)->index()->nullable();
            $table->text("images")->nullable();
            $table->longText("itinerary")->nullable();
            $table->text("price_inclusion")->nullable();
            $table->text("price_exclusion")->nullable();
            $table->text("cruise_policy")->nullable();
            $table->text("booking_policy")->nullable();

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
        Schema::dropIfExists('z_package_translation');
        Schema::dropIfExists('z_packages');
    }
}
