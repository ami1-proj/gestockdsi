<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'articles';

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('reference', 100)->comment('reference de l article');
            $table->string('taille', 100)->nullable()->comment('taille de l article');

            $table->string('reference_complete')->nullable()->comment('référence complète de l article');

            $table->string('model')->comment('model de l article');
            

            $table->dateTime('date_livraison')->comment('date livraison de l article');

            $table->unsignedBigInteger('type_article_id')->nullable()->comment('reference du type de l article');
            $table->foreign('type_article_id')->references('id')->on('type_articles')->onDelete('set null');

            $table->unsignedBigInteger('fournisseur_id')->nullable()->comment('reference du fournisseur');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs')->onDelete('set null');

            $table->unsignedBigInteger('marque_article_id')->nullable()->comment('reference de la marque');
            $table->foreign('marque_article_id')->references('id')->on('marque_articles')->onDelete('set null');

            $table->unsignedBigInteger('etat_article_id')->nullable()->comment('reference de l etat');
            $table->foreign('etat_article_id')->references('id')->on('etat_articles')->onDelete('set null');

            $table->unsignedBigInteger('affectation_id')->nullable()->comment('id de l affectation actuelle de l article');

            $table->unsignedBigInteger('statut_id')->nullable()->comment('reference du statut');
            $table->foreign('statut_id')->references('id')->on('statuts')->onDelete('set null');

            $table->string('tags')->nullable()->comment('Tags, le cas echeant');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `$tableName` comment 'liste des articles du Systeme'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['statut_id']);
            $table->dropForeign(['type_article_id']);
            $table->dropForeign(['fournisseur_id']);
            $table->dropForeign(['marque_article_id']);
            $table->dropForeign(['etat_article_id']);
        });

        // Drop articles_stocks foreign keys if exist
        if (Schema::hasColumn('article_stock', 'article_id')) {
            Schema::table('article_stock', function (Blueprint $pivotstocks) {
                $pivotstocks->dropForeign(['article_id']);
            });
        }

        // Drop articles_affectations foreign keys if exist
        if (Schema::hasColumn('article_employe', 'article_id')) {
            Schema::table('article_employe', function (Blueprint $pivotaffectations) {
                $pivotaffectations->dropForeign(['article_id']);
            });
        }

        // Drop articles_commandes foreign keys if exist
        if (Schema::hasColumn('article_commande', 'article_id')) {
            Schema::table('article_commande', function (Blueprint $pivotcommandes) {
                $pivotcommandes->dropForeign(['article_id']);
            });
        }

        Schema::dropIfExists('articles');
    }
}
