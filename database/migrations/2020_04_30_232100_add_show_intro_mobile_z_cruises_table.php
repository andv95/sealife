<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowIntroMobileZCruisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_cruise_translations', function (Blueprint $table) {
            $table->unsignedInteger("excerpt_show_mobile")->nullable()->after("excerpt");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_cruise_translations', function (Blueprint $table) {
            $table->dropColumn("excerpt_show_mobile");
        });
    }
}
