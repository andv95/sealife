<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZCruisePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_cruise_posts', function (Blueprint $table) {
            $table->unsignedBigInteger("z_cruise_id");
            $table->foreign("z_cruise_id")->references("id")->on("z_cruises")->onDelete("cascade");
            $table->unsignedBigInteger("z_post_id");
            $table->foreign("z_post_id")->references("id")->on("z_posts")->onDelete("cascade");

            $table->primary(['z_cruise_id', 'z_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_cruise_posts');
    }
}
