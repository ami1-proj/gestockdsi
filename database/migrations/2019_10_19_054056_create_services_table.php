<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'services';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('intitule', 100)->comment('intitule du service');
            $table->string('full_path')->nullable()->comment('affiche la structure complete du service : direction/division/service');
            $table->string('alternative_path')->nullable()->comment('affiche l intitule alternatif du service. Permet d eviter d afficher un intitule vide');
            $table->string('designation_complete')->nullable()->comment('designation complete harmonisee');

            $table->unsignedBigInteger('employe_responsable_id')->nullable()->comment('reference de l employe responsable');
            $table->foreign('employe_responsable_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('division_id')->nullable()->comment('reference de la division');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des services'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['employe_responsable_id']);
            $table->dropForeign(['division_id']);
        });
        Schema::dropIfExists('services');
    }
}
