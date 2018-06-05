<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cedula')->nullable()->after('apellidos');
            $table->string('state')->nullable()->after('apellidos');
            $table->string('city')->nullable()->after('apellidos');
            $table->string('association')->nullable()->after('telefono');
            $table->string('federation')->nullable()->after('telefono');
            $table->string('team')->nullable()->after('telefono');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
