<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZNewsPostPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_news_post_packages', function (Blueprint $table) {
            $table->unsignedBigInteger("z_package_id");
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->unsignedBigInteger("z_news_post_id");
            $table->foreign("z_news_post_id")->references("id")->on("z_news_posts")->onDelete("cascade");

            $table->primary(['z_package_id', 'z_news_post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_news_post_packages');
    }
}
