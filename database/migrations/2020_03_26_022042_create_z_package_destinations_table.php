<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPackageDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_package_destinations', function (Blueprint $table) {
            $table->unsignedBigInteger("z_package_id");
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->unsignedBigInteger("z_destination_id");
            $table->foreign("z_destination_id")->references("id")->on("z_destinations")->onDelete("cascade");

            $table->primary(['z_package_id', 'z_destination_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_package_destinations');
    }
}
