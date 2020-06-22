<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'tags';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50)->unique()->comment('nom du tag. doit etre unique');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'Tags du Systeme'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
