<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'employes';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nom')->comment('nom de l employe');
            $table->string('matricule')->comment('matricule de l employe');
            $table->string('prenom')->nullable()->comment('prenom de l employe');
            $table->string('nom_complet')->nullable()->comment('nom complet de l employe');

            $table->string('adresse')->nullable()->comment('adresse de l employe');

            $table->unsignedBigInteger('fonction_employe_id')->nullable()->comment('reference de la fonction de l employe');
            $table->foreign('fonction_employe_id')->references('id')->on('fonction_employes')->onDelete('set null');

            $table->unsignedBigInteger('departement_id')->nullable()->comment('reference du departement d affectation de l employe (le cas echeant)');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'employes'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['fonction_employe_id']);
        });

        // Drop articles_affectations foreign keys if exist
        if (Schema::hasColumn('article_employe', 'employe_id')) {
            Schema::table('article_employe', function (Blueprint $pivotaffectations) {
                $pivotaffectations->dropForeign(['employe_id']);
            });
        }

        // Drop articles_commandes foreign keys if exist
        if (Schema::hasColumn('articles_commandes', 'employe_id')) {
            Schema::table('articles_commandes', function (Blueprint $pivotcommandes) {
                $pivotcommandes->dropForeign(['employe_id']);
            });
        }

        Schema::dropIfExists('employes');
    }
}
