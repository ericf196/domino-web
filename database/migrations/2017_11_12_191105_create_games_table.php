<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index()->foreign()->references("id")->on("categories")->onDelete("cascade");
            $table->integer('user_id')->unsigned()->index()->foreign()->references("id")->on("users")->onDelete("cascade");
            $table->string('jj')->nullable();
            $table->string('jg')->nullable();
            $table->string('jp')->nullable();
            $table->string('pts_p')->nullable();
            $table->string('pts_n')->nullable();
            $table->string('avg')->nullable();
            $table->string('efec')->nullable();
            $table->string('pro')->nullable();
            $table->string('pro_g')->nullable();
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
        Schema::dropIfExists('games');
    }
}
