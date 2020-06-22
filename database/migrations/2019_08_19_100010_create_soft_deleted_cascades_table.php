<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftDeletedCascadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'soft_deleted_cascades';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('recycle_bin_id')->nullable()->comment('id de la suppression rattachée');
            $table->foreign('recycle_bin_id')->references('id')->on('recycle_bin')->onDelete('set null');

            $table->string('object_class_name')->comment('nom de la classe');
            $table->string('object_model_name')->comment('nom du type de model');
            $table->string('object_ids')->comment('liste des id des objets');
            $table->string('foreign_key_field')->comment('nom du champ de la cle etrangere');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Elements cascadés (clé étrangère mise a null) a la suite d un soft delete'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('soft_deleted_cascades', function (Blueprint $table) {
            $table->dropForeign(['recycle_bin_id']);
        });
        Schema::dropIfExists('soft_deleted_cascades');
    }
}
