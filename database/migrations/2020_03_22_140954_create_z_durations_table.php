<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZDurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_durations', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_duration_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_duration_id")->index()->nullable();
            $table->foreign("z_duration_id")->references("id")->on("z_durations")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_duration_id", "locale"]);

            $table->string("name", 50)->nullable();
            $table->string("short_name", 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_duration_translations');
        Schema::dropIfExists('z_durations');
    }
}
