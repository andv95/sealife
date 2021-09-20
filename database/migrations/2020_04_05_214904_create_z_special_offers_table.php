<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZSpecialOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_special_offers', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_special_offer_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_special_offer_id")->index()->nullable();
            $table->foreign("z_special_offer_id")->references("id")->on("z_special_offers")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_special_offer_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("short_desc", 500)->nullable();
            $table->string("invalid_desc", 500)->nullable();
        });

        Schema::create('z_package_special_offers', function (Blueprint $table) {
            $table->unsignedBigInteger("z_package_id");
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->unsignedBigInteger("z_special_offer_id");
            $table->foreign("z_special_offer_id")->references("id")->on("z_special_offers")->onDelete("cascade");

            $table->primary(['z_package_id', 'z_special_offer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_special_offer_translations');
        Schema::dropIfExists('z_special_offers');
    }
}
