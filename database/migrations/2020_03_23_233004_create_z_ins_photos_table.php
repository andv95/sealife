<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZInsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_ins_photos', function (Blueprint $table) {
            $table->id();

            $table->string("url", 500)->nullable();
            $table->string("tag", 100)->nullable();
            $table->string("alt", 2000);
            $table->string("caption", 2000)->nullable();
            $table->unsignedSmallInteger("position_no")->nullable();

            $table->boolean("active_flg")->default(false)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_ins_photos');
    }
}
