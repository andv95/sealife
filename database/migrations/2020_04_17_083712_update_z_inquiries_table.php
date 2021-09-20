<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_inquiries', function (Blueprint $table) {
            $table->unsignedBigInteger("z_room_id")->nullable()->after("z_package_id")->index();
            $table->string("promotion_text", 255)->nullable()->after("z_room_id");
            $table->string("promotion_price", 255)->nullable()->after("promotion_text");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_inquiries', function (Blueprint $table) {
            $table->dropColumn("z_room_id");
            $table->dropColumn("promotion_text");
            $table->dropColumn("promotion_price");
        });
    }
}
