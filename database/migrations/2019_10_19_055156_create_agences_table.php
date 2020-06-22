<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'agences';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('intitule', 100)->comment('intitule de la agence');
            $table->string('full_path')->nullable()->comment('affiche la structure complete de la agence : zone/agence');
            $table->string('alternative_path')->nullable()->comment('affiche l intitule alternatif de la agence. Permet d eviter d afficher un intitule vide');
            $table->string('designation_complete')->nullable()->comment('designation complete harmonisee');

            $table->unsignedBigInteger('employe_responsable_id')->nullable()->comment('reference de l employe responsable');
            $table->foreign('employe_responsable_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('zone_id')->nullable()->comment('reference de la zone');
            $table->foreign('zone_id')->references('id')->on('directions')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des agences'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agences', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['employe_responsable_id']);
            $table->dropForeign(['zone_id']);
        });
        Schema::dropIfExists('agences');
    }
}
