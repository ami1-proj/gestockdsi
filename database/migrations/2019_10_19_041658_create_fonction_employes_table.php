<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFonctionEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'fonction_employes';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('intitule')->comment('intitule de la fonction');
            $table->string('slug')->unique()->comment('intitule de la fonction');
            $table->string('description')->nullable()->comment('description de la fonction');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des fonctions des employes'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fonction_employes', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
        });
        Schema::dropIfExists('fonction_employes');
    }
}
