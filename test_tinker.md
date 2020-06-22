// Décompte du nombre d'article
App\Article::count();

// 1. Vérifier la situation d'un Article
$a = App\Article::find(3);
// afficher le statut
$a->statut;
// afficher la marque de l'Article
$a->marqueArticle;
// afficher le fournisseur
$a->fournisseur;
// typeArticle
$a->typeArticle;
