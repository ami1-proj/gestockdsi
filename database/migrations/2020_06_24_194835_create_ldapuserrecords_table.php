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

            $table->string('ldap_cn')->nullable()->comment('nom complet');
            $table->string('ldap_cn_result')->nullable()->comment('ldap_cn result');
            $table->string('ldap_sn')->nullable()->comment('nom de famille');
            $table->string('ldap_sn_result')->nullable()->comment('ldap_sn result');
            $table->string('ldap_title')->nullable()->comment('titre de l employe');
            $table->string('ldap_title_result')->nullable()->comment('ldap_title result');
            $table->string('ldap_description')->nullable()->comment('fonction de l employe');
            $table->string('ldap_description_result')->nullable()->comment('ldap_description result');
            $table->string('ldap_physicaldeliveryofficename')->nullable()->comment('unité d affectation');
            $table->string('ldap_physicaldeliveryofficename_result')->nullable()->comment('ldap_physicaldeliveryofficename result');
            $table->string('ldap_telephonenumber')->nullable()->comment('numero de telephone de l employé');
            $table->string('ldap_telephonenumber_result')->nullable()->comment('telephonenumber result');
            $table->string('ldap_givenname')->nullable()->comment('prénom de l employé');
            $table->string('ldap_givenname_result')->nullable()->comment('ldap_givenname result');
            $table->string('ldap_distinguishedname')->nullable()->comment('infos complets de l employé');
            $table->string('ldap_distinguishedname_result')->nullable()->comment('ldap_distinguishedname result');
            $table->string('ldap_whencreated')->nullable()->comment('date creation');
            $table->string('ldap_whencreated_result')->nullable()->comment('ldap_whencreated result');
            $table->string('ldap_whenchanged')->nullable()->comment('date dernière modif');
            $table->string('ldap_whenchanged_result')->nullable()->comment('ldap_whenchanged result');
            $table->string('ldap_department')->nullable()->comment('departement de l employe');
            $table->string('ldap_department_result')->nullable()->comment('ldap_department result');
            $table->string('ldap_company')->nullable()->comment('entreprise de l employe');
            $table->string('ldap_company_result')->nullable()->comment('ldap_company result');
            $table->string('ldap_name')->nullable()->comment('nom de famille');
            $table->string('ldap_name_result')->nullable()->comment('ldap_name result');
            $table->string('ldap_badpwdcount')->nullable()->comment('nombre de mot de passe érroné');
            $table->string('ldap_badpwdcount_result')->nullable()->comment('ldap_badpwdcount result');
            $table->string('ldap_logoncount')->nullable()->comment('nombre d authentification');
            $table->string('ldap_logoncount_result')->nullable()->comment('ldap_logoncount result');
            $table->string('ldap_mail')->nullable()->comment('adresse e-mail');
            $table->string('ldap_mail_result')->nullable()->comment('ldap_mail result');
            $table->string('ldap_thumbnailphoto')->nullable()->comment('photo de profil');
            $table->string('ldap_thumbnailphoto_result')->nullable()->comment('ldap_thumbnailphoto result');

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
