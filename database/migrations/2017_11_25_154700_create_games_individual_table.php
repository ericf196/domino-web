<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesIndividualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_individual', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index()->foreign()->references("id")->on("categories")->onDelete("cascade");
            $table->integer('user_id')->unsigned()->index()->foreign()->references("id")->on("users")->onDelete("cascade");
            $table->string('jj')->nullable();
            $table->string('jg')->nullable();
            $table->string('jp')->nullable();
            $table->string('pts_p')->nullable();
            $table->string('pts_n')->nullable();
            $table->string('pts_n_p')->nullable();
            $table->string('pts_p_p')->nullable();
            $table->string('avg')->nullable();
            $table->string('efec')->nullable();
            $table->string('pro')->nullable();
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
        Schema::dropIfExists('games_individual');
    }
}
