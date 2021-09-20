<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string("language_key", 10)->unique()->index();
            $table->string("latin_name", 20)->nullable();
            $table->string("native_name", 20)->nullable();
            $table->string("script", 20)->nullable();
            $table->string("regional", 10)->nullable();

            $table->tinyInteger("order_no")->nullable();
            $table->text("remark")->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

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
        Schema::dropIfExists('languages');
    }
}
