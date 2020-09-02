<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('followers') && Schema::hasTable('keywords')) {
            Schema::create('card_keywords', function (Blueprint $table) {
                $table->increments("relationship_id");
                $table->string("id_card");
                // $table->foreign("id_card")->references("id")->on("followers");
                $table->string("id_keyword");
                // $table->foreign("id_keyword")->references("id")->on("keywords");
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_keywords');
    }
}
