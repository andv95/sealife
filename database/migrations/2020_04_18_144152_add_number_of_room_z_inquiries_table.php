<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumberOfRoomZInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_inquiries', function (Blueprint $table) {
            $table->unsignedSmallInteger("number_of_room")->default(1)->nullable();
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
            $table->dropColumn("number_of_room");
        });
    }
}
