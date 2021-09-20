<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_contacts', function (Blueprint $table) {
            $table->id();

            $table->string("first_name", 100)->nullable();
            $table->string("last_name", 100)->nullable();
            $table->string("email", 100)->nullable();
            $table->string("phone", 50)->nullable();
            $table->string("looking_for", 2000)->nullable();
            $table->string("interested_in", 2000)->nullable();
            $table->string("something_else", 2000)->nullable();

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
        Schema::dropIfExists('z_contacts');
    }
}
