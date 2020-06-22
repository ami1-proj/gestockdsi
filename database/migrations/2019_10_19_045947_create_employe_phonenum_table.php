<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployePhonenumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'employe_phonenum';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('rang')->nullable()->comment('rang du numero de telephone dans la liste');

            $table->unsignedBigInteger('employe_id')->nullable()->comment('reference de l employe');
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('set null');

            $table->unsignedBigInteger('phonenum_id')->nullable()->comment('reference du numero de telephone');
            $table->foreign('phonenum_id')->references('id')->on('phonenums')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');
            $table->index(['employe_id','rang']);

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des numeros de telephones d un employe'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employe_phonenum', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['employe_id']);
            $table->dropForeign(['phonenum_id']);

            $table->dropIndex(['employe_id','rang']);
        });
        Schema::dropIfExists('employe_phonenum');
    }
}
