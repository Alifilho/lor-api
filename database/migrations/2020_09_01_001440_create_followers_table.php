<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->string("asset", 70);
            $table->string("region", 40);
            $table->smallInteger("attack");
            $table->smallInteger("cost");
            $table->smallInteger("health");
            $table->string("description", 100)->nullable();
            $table->string("flavor_text", 100);
            $table->string("artist_name", 50);
            $table->string("name", 50);
            $table->string("card_code", 20)->unique()->primary();
            $table->string("rarity", 10);
            $table->string("subtype", 25)->nullable();
            $table->boolean("collectible");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
