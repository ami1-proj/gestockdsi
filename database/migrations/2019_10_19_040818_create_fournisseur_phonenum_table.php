<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseurPhonenumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'fournisseur_phonenum';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('rang')->nullable()->comment('rang du nemero de telephone dans la liste');

            $table->unsignedBigInteger('fournisseur_id')->nullable()->comment('reference du fournisseur');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('set null');

            $table->unsignedBigInteger('phonenum_id')->nullable()->comment('reference du numero de telephone');
            $table->foreign('phonenum_id')->references('id')->on('phonenums')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->index(['fournisseur_id','rang']);

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des numeros de telephones d un fournisseurs'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fournisseur_phonenum', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['fournisseur_id']);
            $table->dropForeign(['phonenum_id']);

            $table->dropIndex(['fournisseur_id','rang']);
        });
        Schema::dropIfExists('fournisseur_phonenum');
    }
}
