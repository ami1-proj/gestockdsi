<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Article;
use App\EtatArticle;

class ArticleSetEtat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:setetat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Met a jour les etats des articles suivant certains criteres';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $etatarticle_ancien = EtatArticle::tagged('Ancien')->first();
        $duree_jrs_min_article_neuf = 10;

        \Log::info("Cron en cours de traitement...");

        $articles = Article::get();
        foreach ($articles as $article) {

            if ($article->situation()->typeaffectation->tags == 'Stock') {

            } else {
                $affectationarticle = $article->affectation;
                if($affectationarticle->duration->days > $duree_jrs_min_article_neuf && $article->etat_article_id != $etatarticle_ancien->id) {
                    $article->etat_article_id = $etatarticle_ancien->id;
                    $article->save();
                    \Log::info("Article ". $article->id ." passe a etat ANCIEN apres " . $affectationarticle->duration->days . " jrs atteint en affectation. Duree minimale: " . $duree_jrs_min_article_neuf . " ");
                }
            }

        }

        $this->info('Command article:setetat Command execute avec succes!');
        \Log::info("Traitement termine.");
    }
}
