<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseemailFournisseurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'adresseemail_fournisseur';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('rang')->nullable()->comment('rang de l adresse email dans la liste');

            $table->unsignedBigInteger('fournisseur_id')->nullable()->comment('reference du fournisseur');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('set null');

            $table->unsignedBigInteger('adresseemail_id')->nullable()->comment('reference de l adresse e-mail');
            $table->foreign('adresseemail_id')->references('id')->on('adresseemails')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');
            $table->index(['fournisseur_id','rang']);

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des adresse e-mail d un fournisseur'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adresseemail_fournisseur', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['fournisseur_id']);
            $table->dropForeign(['adresseemail_id']);

            $table->dropIndex(['fournisseur_id','rang']);
        });
        Schema::dropIfExists('adresseemail_fournisseur');
    }
}
