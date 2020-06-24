<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLdapimportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'ldapimports';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->nullable()->comment('Account Name');
            $table->string('name')->nullable()->comment('Name');
            $table->string('email')->nullable()->comment('User e-mail');

            $table->string('objectguid')->nullable()->comment('UID');
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
        Schema::dropIfExists('ldapimport');
    }
}
