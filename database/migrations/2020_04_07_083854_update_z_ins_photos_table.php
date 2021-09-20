<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateZInsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('z_ins_photos', function (Blueprint $table) {
            $table->string("ig_media_id", 255)->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('z_ins_photos', function (Blueprint $table) {
            $table->dropColumn("ig_media_id");
        });
    }
}
