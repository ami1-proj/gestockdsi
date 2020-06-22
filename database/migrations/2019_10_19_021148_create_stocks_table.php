<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'stocks';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nom', 100)->comment('nom du stock');

            $table->unsignedBigInteger('lieu_id')->nullable()->comment('reference du lieu');
            $table->foreign('lieu_id')->references('id')->on('stock_lieus')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'Stock pour l entreposage physique d articles'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['lieu_id']);
        });

        // Drop articles_stocks foreign keys if exist
        if (Schema::hasColumn('article_stock', 'stock_id')) {
            Schema::table('article_stock', function (Blueprint $pivottable) {
                $pivottable->dropForeign(['stock_id']);
            });
        }

        Schema::dropIfExists('stocks');
    }
}
