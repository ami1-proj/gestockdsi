<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'statuts';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('libelle', 100)->comment('Libelle du statut');
            $table->string('code', 100)->comment('Code du statut');
            $table->boolean('is_default')->is_default(false)->comment('indique le statut par defaut');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'Statut des objets du Systeme'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuts');
    }
}
