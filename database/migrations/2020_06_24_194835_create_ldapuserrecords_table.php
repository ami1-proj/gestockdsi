<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLdapuserrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'ldapuserrecords';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'enregistrement d un user LDAP'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ldapuserrecords');
    }
}
