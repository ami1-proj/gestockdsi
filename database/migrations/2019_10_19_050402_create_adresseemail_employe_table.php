<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdresseemailEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'adresseemail_employe';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('rang')->nullable()->comment('rang de l adresse e-mail dans la liste');

            $table->unsignedBigInteger('employe_id')->nullable()->comment('reference de l employe');
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('adresseemail_id')->nullable()->comment('reference de l adresse e-mail');
            $table->foreign('adresseemail_id')->references('id')->on('adresseemails')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');
            $table->index(['employe_id','rang']);

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des adresse e-mail d un employe'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()

    {
        Schema::table('adresseemail_employe', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['employe_id']);
            $table->dropForeign(['adresseemail_id']);

            $table->dropIndex(['employe_id','rang']);
        });
        Schema::dropIfExists('adresseemail_employe');
    }
}
