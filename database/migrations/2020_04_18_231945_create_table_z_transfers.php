<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableZTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_transfers', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->unsignedTinyInteger("order_no")->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_transfer_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_transfer_id")->index()->nullable();
            $table->foreign("z_transfer_id")->references("id")->on("z_transfers")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_transfer_id", "locale"]);

            $table->string("name", 255)->nullable();
        });

        Schema::create('z_package_transfers', function (Blueprint $table) {
            $table->unsignedBigInteger("z_package_id");
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->unsignedBigInteger("z_transfer_id");
            $table->foreign("z_transfer_id")->references("id")->on("z_transfers")->onDelete("cascade");

            $table->primary(['z_package_id', 'z_transfer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_package_transfers');
        Schema::dropIfExists('z_transfer_translations');
        Schema::dropIfExists('z_transfers');
    }
}
