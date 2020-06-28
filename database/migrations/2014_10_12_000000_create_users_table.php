<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique()->comment('login du compte ou première partie de l adresse e-mail');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('image')->nullable()->comment('Avatar de l utilisateur');

            $table->boolean('is_local')->is_default(false)->comment('indique si le compte est locale');
            $table->boolean('is_ldap')->is_default(false)->comment('indique si le compte est LDAP');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->unsignedBigInteger('ldapaccount_id')->nullable()->comment('reference du compte LDAP');
            $table->string('objectguid')->nullable()->comment('GUID du compte');

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
        Schema::dropIfExists('users');
    }
}
