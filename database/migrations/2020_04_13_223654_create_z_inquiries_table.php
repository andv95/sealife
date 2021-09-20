<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_inquiries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('z_package_id')->nullable();
            $table->date('start_date')->nullable();
            $table->unsignedInteger('quantity_adults')->nullable();
            $table->unsignedInteger('quantity_children')->nullable();
            $table->unsignedInteger('quantity_infants')->nullable();
            $table->unsignedSmallInteger('transfer')->nullable();
            $table->unsignedSmallInteger('title')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->text('special_request')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_inquiries');
    }
}
