<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'commandes';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('objet_commande')->comment('objet de la commande');
            $table->string('description_commande')->nullable()->comment('description de la commande');

            $table->unsignedBigInteger('etat_commande_id')->nullable()->comment('reference de l etat de la commande');
            $table->foreign('etat_commande_id')->references('id')->on('etat_commandes')->onDelete('set null');

            $table->unsignedBigInteger('employe_id')->nullable()->comment('reference de l employe qui effectue la commande');
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des commandes(s)'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['etat_commande_id']);
            $table->dropForeign(['employe_id']);
        });
        Schema::dropIfExists('commandes');
    }
}
