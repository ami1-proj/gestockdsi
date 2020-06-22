<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffectationArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'affectation_article';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->dateTime('date_debut')->comment('marque le debut de la liaison de l article a cette affectation');
            $table->string('details_debut')->nullable()->comment('details supplementaires sur le mouvement a l ajout de l article');

            $table->dateTime('date_fin')->nullable()->comment('marque la fin de la liaison de l article a cette affectation');
            $table->string('details_fin')->nullable()->comment('details supplementaires sur le mouvement au retrait de l article');

            $table->unsignedBigInteger('article_id')->nullable()->comment('reference de l article');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('set null');

            $table->unsignedBigInteger('type_mouvement_id')->nullable()->comment('reference du type de mouvement de l article');
            $table->foreign('type_mouvement_id')->references('id')->on('type_mouvements')->onDelete('set null');

            $table->unsignedBigInteger('affectation_id')->nullable()->comment('reference de l affectation qui recoit l article');
            $table->foreign('affectation_id')->references('id')->on('affectations')->onDelete('set null');

            // $table->unsignedBigInteger('affectation_from_id')->nullable()->comment('reference de l affectation qui donne l article (le cas echeant)');
            // $table->foreign('affectation_from_id')->references('id')->on('affectations')->onDelete('set null');

            $table->unsignedBigInteger('prev_affectationarticle_id')->nullable()->comment('reference du mouvement precedent de l article (le cas echeant)');
            $table->unsignedBigInteger('next_affectationarticle_id')->nullable()->comment('reference du mouvement suivant l article (le cas echeant)');

            $table->unsignedBigInteger('stock_emplacement_id')->nullable()->comment('reference de l emplacement');
            $table->foreign('stock_emplacement_id')->references('id')->on('stock_emplacements')->onDelete('set null');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `$tableName` comment 'mouvements des article dans une affectation donnee'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affectation_article', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['article_id']);
            $table->dropForeign(['type_mouvement_id']);
            $table->dropForeign(['affectation_id']);
            //$table->dropForeign(['affectation_from_id']);
            $table->dropForeign(['stock_emplacement_id']);
        });
        Schema::dropIfExists('affectation_article');
    }
}
