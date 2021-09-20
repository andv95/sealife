<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNoToZPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_packages', function (Blueprint $table) {
            $table->unsignedInteger("order_no")->nullable()->after("z_duration_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_packages', function (Blueprint $table) {
            $table->dropColumn("order_no");
        });
    }
}
