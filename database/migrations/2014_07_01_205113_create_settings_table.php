<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'settings';
        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('group')->comment('groupe');
            $table->string('name')->comment('clé');
            $table->string('value')->nullable()->comment('valeur');
            $table->string('type')->default("string")->comment('type de la donnée (valeur)');
            $table->string('array_sep')->default(",")->comment('séparateur de tableau le cas échéant');
            $table->string('description')->nullable()->comment('description');

            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'Custom Settings de l Application'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
