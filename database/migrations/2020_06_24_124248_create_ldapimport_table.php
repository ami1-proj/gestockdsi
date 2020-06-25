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
            $table->string('password')->nullable()->comment('PWD');

            $table->string('ldap_cn')->nullable()->comment('nom complet');
            $table->string('cn_result')->nullable()->comment('ldap_cn result');

            $table->string('ldap_sn')->nullable()->comment('nom de famille');
            $table->string('sn_result')->nullable()->comment('ldap_sn result');

            $table->string('ldap_title')->nullable()->comment('titre de l employe');
            $table->string('title_result')->nullable()->comment('ldap_title result');

            $table->string('ldap_description')->nullable()->comment('fonction de l employe');
            $table->string('description_result')->nullable()->comment('ldap_description result');

            $table->string('ldap_physicaldeliveryofficename')->nullable()->comment('unité d affectation');
            $table->string('physicaldeliveryofficename_result')->nullable()->comment('ldap_physicaldeliveryofficename result');

            $table->string('ldap_telephonenumber')->nullable()->comment('numero de telephone de l employé');
            $table->string('telephonenumber_result')->nullable()->comment('telephonenumber result');

            $table->string('ldap_givenname')->nullable()->comment('prénom de l employé');
            $table->string('givenname_result')->nullable()->comment('ldap_givenname result');

            $table->string('ldap_distinguishedname')->nullable()->comment('infos complets de l employé');
            $table->string('distinguishedname_result')->nullable()->comment('ldap_distinguishedname result');

            $table->string('service')->nullable()->comment('service deduit apres traitement');
            $table->string('division')->nullable()->comment('division deduite apres traitement');
            $table->string('direction')->nullable()->comment('direction deduite apres traitement');
            $table->string('agence')->nullable()->comment('agence deduite apres traitement');
            $table->string('zone')->nullable()->comment('zone deduite apres traitement');

            $table->string('ldap_whencreated')->nullable()->comment('date creation');
            $table->string('whencreated_result')->nullable()->comment('ldap_whencreated result');

            $table->string('ldap_whenchanged')->nullable()->comment('date dernière modif');
            $table->string('whenchanged_result')->nullable()->comment('ldap_whenchanged result');

            $table->string('ldap_department')->nullable()->comment('departement de l employe');
            $table->string('department_result')->nullable()->comment('ldap_department result');

            $table->string('ldap_company')->nullable()->comment('entreprise de l employe');
            $table->string('company_result')->nullable()->comment('ldap_company result');

            $table->string('ldap_name')->nullable()->comment('nom de famille');
            $table->string('name_result')->nullable()->comment('ldap_name result');

            $table->string('ldap_badpwdcount')->nullable()->comment('nombre de mot de passe érroné');
            $table->string('badpwdcount_result')->nullable()->comment('ldap_badpwdcount result');

            $table->string('ldap_logoncount')->nullable()->comment('nombre d authentification');
            $table->string('logoncount_result')->nullable()->comment('ldap_logoncount result');

            $table->string('ldap_mail')->nullable()->comment('adresse e-mail');
            $table->string('mail_result')->nullable()->comment('ldap_mail result');

            $table->binary('ldap_thumbnailphoto')->nullable()->comment('photo de profil');
            $table->string('thumbnailphoto_result')->nullable()->comment('ldap_thumbnailphoto result');

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
        Schema::dropIfExists('ldapimports');
    }
}
