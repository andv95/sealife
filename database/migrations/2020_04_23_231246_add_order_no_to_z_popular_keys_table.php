<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNoToZPopularKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_popular_keys', function (Blueprint $table) {
            $table->unsignedInteger("order_no")->nullable()->after("global_name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_popular_keys', function (Blueprint $table) {
            $table->dropColumn("order_no");
        });
    }
}
