<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'departements';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('intitule', 100)->comment('intitule du departement');
            $table->string('chemin_complet')->nullable()->comment('chemin complet du departement en tenant compte des parents');
            $table->string('description')->nullable()->comment('description du departement');

            $table->unsignedBigInteger('employe_responsable_id')->nullable()->comment('reference de l employe responsable');
            $table->foreign('employe_responsable_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('type_departement_id')->nullable()->comment('reference du type de departement');
            $table->foreign('type_departement_id')->references('id')->on('type_departements')->onDelete('set null');

            $table->unsignedBigInteger('departement_parent_id')->nullable()->comment('reference du departement parent');
            $table->foreign('departement_parent_id')->references('id')->on('departements')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des departements'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departements', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['departement_parent_id']);
            $table->dropForeign(['employe_responsable_id']);
            $table->dropForeign(['type_departement_id']);
        });
        Schema::dropIfExists('departements');
    }
}
