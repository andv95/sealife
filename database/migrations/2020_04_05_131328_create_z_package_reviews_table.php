<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZPackageReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_package_reviews', function (Blueprint $table) {
            $table->unsignedBigInteger("z_package_id");
            $table->foreign("z_package_id")->references("id")->on("z_packages")->onDelete("cascade");
            $table->unsignedBigInteger("z_review_id");
            $table->foreign("z_review_id")->references("id")->on("z_reviews")->onDelete("cascade");

            $table->primary(['z_package_id', 'z_review_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_package_reviews');
    }
}
