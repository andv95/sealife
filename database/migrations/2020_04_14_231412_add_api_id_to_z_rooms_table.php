<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiIdToZRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_rooms', function (Blueprint $table) {
            $table->string("api_id", 25)->nullable()->index()->after("id");
        });

        Schema::table('z_room_translations', function (Blueprint $table) {
            $table->dropColumn("price");
            $table->dropColumn("price_unit");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_rooms', function (Blueprint $table) {
            $table->dropColumn("api_id");
        });

        Schema::table('z_room_translations', function (Blueprint $table) {
            $table->unsignedFloat("price")->nullable();
            $table->string("price_unit", 20)->nullable();
        });
    }
}
