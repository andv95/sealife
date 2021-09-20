<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPackageOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_package_offers', function (Blueprint $table) {
            $table->unsignedBigInteger("z_package_id");
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->unsignedBigInteger("z_offer_id");
            $table->foreign("z_offer_id")->references("id")->on("z_offers")->onDelete("cascade");

            $table->primary(['z_package_id', 'z_offer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_package_offers');
    }
}
