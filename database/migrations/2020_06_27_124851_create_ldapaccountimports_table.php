<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLdapaccountimportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'ldapaccountimports';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('objectguid')->nullable()->comment('GUID du compte');
            $table->string('username')->nullable()->comment('Account Name');
            $table->string('name')->nullable()->comment('nom complet du compte');

            $table->string('email')->nullable()->comment('e-mail du compte');
            $table->string('password')->nullable()->comment('mot de passe du compte');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'derniere importation LDAP'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ldapaccountimports');
    }
}
