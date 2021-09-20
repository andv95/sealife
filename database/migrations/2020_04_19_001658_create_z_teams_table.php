<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_teams', function (Blueprint $table) {
            $table->id();

            $table->string("global_name", 50)->nullable();
            $table->unsignedSmallInteger("branch")->nullable();

            $table->boolean("active_flg")->default(true)->nullable();

            $table->timestamps();
        });

        Schema::create('z_team_translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("z_team_id")->index()->nullable();
            $table->foreign("z_team_id")->references("id")->on("z_teams")->onDelete("cascade");
            $table->string("locale", 5)->index();
            $table->foreign("locale")->references("language_key")->on("languages")->onDelete("cascade");
            $table->unique(["z_team_id", "locale"]);

            $table->string("name", 255)->nullable();
            $table->string("position", 50)->nullable();
            $table->string("image", 255)->nullable();
            $table->text("content")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_team_translations');
        Schema::dropIfExists('z_teams');
    }
}
