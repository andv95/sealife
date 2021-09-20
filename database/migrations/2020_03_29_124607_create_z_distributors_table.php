<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZDistributorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_distributors', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->string("order_no")->nullable();

            $table->timestamps();
        });

        Schema::create('z_distributor_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_distributor_id")->index()->nullable();
            $table->foreign("z_distributor_id")->references("id")->on("z_distributors")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_distributor_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("phone", 255)->nullable();
            $table->string("email", 255)->nullable();
            $table->string("address", 255)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_distributor_translations');
        Schema::dropIfExists('z_distributors');
    }
}
