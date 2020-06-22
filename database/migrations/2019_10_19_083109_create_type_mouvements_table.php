<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeMouvementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'type_mouvements';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle')->comment('libelle du type de mouvement');
            $table->boolean('is_default')->is_default(false)->comment('indique le type de mouvement par defaut');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'le type de mouvement de l article'");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('type_mouvements', function (Blueprint $table) {
          $table->dropForeign(['statut_id']);
        });

        Schema::dropIfExists('type_mouvements');
    }
}
