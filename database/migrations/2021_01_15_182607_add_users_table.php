<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //En la tabla users crea un campo imagen y sus valores como null y lo agrega despues de email_verified_at 
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('imagen')
            ->after('email_verified_at')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
