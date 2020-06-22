<?php

use Illuminate\Database\Seeder;
use App\Article;
use App\Statut;
use App\Traits\ArticleTrait;

class InsertFakeArticles extends Seeder
{
    use ArticleTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class, 10)->create();

        // Materialiser la situation (en stock) de tous les articles
        $this->MaterialiserTousLesArticlesEnStock();

        //factory(App\ArticlesAffectation::class, 10)->create();
        //factory(App\ArticlesCommande::class, 10)->create();

    }

    private function MaterialiserTousLesArticlesEnStock(){
      $article_id_min = DB::table('articles')->min('id');
      $article_id_max = DB::table('articles')->max('id');

      $emplacement_id_max = DB::table('stock_emplacements')->max('id');
      $emplacement_id_max = DB::table('stock_emplacements')->max('id');

      for ($article_id=$article_id_min; $article_id <= $article_id_max; $article_id++) {
        $article = Article::find($article_id);
        $article->affecter(1, 1, 'Nouvel Article');
        //$emplacement_id = rand($emplacement_id_max, $emplacement_id_max);
        //$this->AffecterArticle($article_id,1,1,$emplacement_id);
      }
    }
}
