<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecycleBinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'recycle_bin';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('object_class_name')->comment('nom de la classe de l objet');
            $table->unsignedBigInteger('object_id')->comment('id de l objet supprime');
            $table->unsignedBigInteger('user_id')->comment('id l utilisateur qui a supprime l objet');
            $table->string('object_denomination')->comment('denomination de l objet supprime');
            $table->string('object_model_name')->comment('nom du model de l objet supprime');
            $table->boolean('is_soft_deleted')->is_default(false)->comment('indique si l objet peut etre restaure');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Elements (récemment) supprimés dans le système'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recycle_bin');
    }
}
