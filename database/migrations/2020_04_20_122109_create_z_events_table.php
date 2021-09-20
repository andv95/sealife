<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_events', function (Blueprint $table) {
            $table->id();

            $table->string("service", 255)->nullable();
            $table->string("group_size", 500)->nullable();
            $table->string('email', 100)->nullable();
            $table->text("event_detail")->nullable();

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
        Schema::dropIfExists('z_events');
    }
}
