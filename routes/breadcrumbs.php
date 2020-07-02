<?php

use App\User;
use App\TypeArticle;
use App\Affectation;
use App\Article;
use App\Fournisseur;
use App\Employe;
use App\Departement;
use App\MarqueArticle;
use App\FonctionEmploye;
use Spatie\Permission\Models\Role;

use App\Statut;
use App\RecycleBin;
use App\EtatArticle;
use App\TypeAffectation;
use App\TypeMouvement;
use App\EtatCommande;
use App\TypeDepartement;


// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});


/**
 * [Breadcrumbs Utilisateurs]
 *
 */
// Home > Utilisateurs
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push('Utilisateurs', route('users.index'));
});

// Home > Utilisateurs > Nouveau
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push('Nouveau', route('users.create'));
});

// Home > Utilisateurs > [User]
Breadcrumbs::for('users.show', function ($trail, $id) {
    $user = User::findOrFail($id);
    $trail->parent('users');
    $trail->push($user->name, route('users.show', $user));
});

// Home > Utilisateurs > [User] > Modification
Breadcrumbs::for('users.edit', function ($trail, $id) {
    $user = User::findOrFail($id);
    $trail->parent('users.show', $id);
    $trail->push('Modification', route('users.edit', $user));
});


/**
 * [Breadcrumbs Roles]
 *
 */
// Home > Roles
Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('roles.index'));
});

// Home > Roles > Nouveau
Breadcrumbs::for('roles.create', function ($trail) {
    $trail->parent('roles');
    $trail->push('Nouveau', route('roles.create'));
});

// Home > Roles > [Role]
Breadcrumbs::for('roles.show', function ($trail, $id) {
    $role = Role::findOrFail($id);
    $trail->parent('roles');
    $trail->push($role->name, route('roles.show', $role));
});

// Home > Roles > [Role] > Modification
Breadcrumbs::for('roles.edit', function ($trail, $id) {
    $role = Role::findOrFail($id);
    $trail->parent('roles.show', $id);
    $trail->push('Modification', route('roles.edit', $role));
});

/**
 * [Breadcrumbs Types Article]
 *
 */
// Home > Types Article
Breadcrumbs::for('typearticles', function ($trail) {
    $trail->parent('home');
    $trail->push('Types Article', route('typearticles.index'));
});

// Home > Types Article > Nouveau
Breadcrumbs::for('typearticles.create', function ($trail) {
    $trail->parent('typearticles');
    $trail->push('Nouveau', route('typearticles.create'));
});

// Home > Types Article > [TypeArticle]
Breadcrumbs::for('typearticles.show', function ($trail, $id) {
    $typearticle = TypeArticle::findOrFail($id);
    $trail->parent('typearticles');
    $trail->push($typearticle->libelle, route('typearticles.show', $typearticle));
});

// Home > Types Article > [TypeArticle] > Modification
Breadcrumbs::for('typearticles.edit', function ($trail, $id) {
    $typearticle = TypeArticle::findOrFail($id);
    $trail->parent('typearticles.show', $id);
    $trail->push('Modification', route('typearticles.edit', $typearticle));
});

/**
 * [Breadcrumbs Articles]
 *
 */
// Home > Articles
Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('home');
    $trail->push('Articles', route('articles.index'));
});

// Home > Articles > Nouveau
Breadcrumbs::for('articles.create', function ($trail) {
    $trail->parent('articles');
    $trail->push('Nouveau', route('articles.create'));
});

// Home > Articles > [Article]
Breadcrumbs::for('articles.show', function ($trail, $id) {
    $article = Article::findOrFail($id);
    $trail->parent('articles');
    $trail->push($article->reference_complete, route('articles.show', $article));
});

// Home > Articles > [Article] > Modification
Breadcrumbs::for('articles.edit', function ($trail, $id) {
    $article = Article::findOrFail($id);
    $trail->parent('articles.show', $id);
    $trail->push('Modification', route('articles.edit', $article));
});


/**
 * [Breadcrumbs Employes]
 *
 */
// Home > Employes
Breadcrumbs::for('employes', function ($trail) {
    $trail->parent('home');
    $trail->push('Employes', route('employes.index'));
});

// Home > Employes > Nouveau
Breadcrumbs::for('employes.create', function ($trail) {
    $trail->parent('employes');
    $trail->push('Nouveau', route('employes.create'));
});

// Home > Employes > [Employe]
Breadcrumbs::for('employes.show', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes');
    $trail->push($employe->nom_complet, route('employes.show', $employe));
});

// Home > Employes > [Employe] > Modification
Breadcrumbs::for('employes.edit', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.show', $id);
    $trail->push('Modification', route('employes.edit', $employe));
});

// Home > Employes > [Employe] > Modification > e-mails
Breadcrumbs::for('employes.emails', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.edit', $id);
    $trail->push('e-mails');
});

// Home > Employes > [Employe] > Modification > Telephones
Breadcrumbs::for('employes.phonenums', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.edit', $id);
    $trail->push('Telephones');
});

// Home > Employes > [Employe] > Nouvelle Affectation
Breadcrumbs::for('employes.affectation.create', function ($trail, $id) {
    $employe = Employe::findOrFail($id);
    $trail->parent('employes.show', $id);
    $trail->push('Nouvelle Affectation', route('affectations.elemcreate',['Employe', $employe->id]));
});

// Home > Employes > [Employe] > Modification Affectation
Breadcrumbs::for('employes.affectation.edit', function ($trail, $emp_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('employes.show', $emp_id);
    $trail->push('Modification Affectation', route('affectations.edit', $aff_id));
});

// Home > Employes > [Employe] > Détails Affectation
Breadcrumbs::for('employes.affectation.show', function ($trail, $emp_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('employes.show', $emp_id);
    $trail->push('Détails Affectation: ' . $aff->objet, route('affectations.show', $aff_id));
});

// Home > Employes > [Employe] > Détails Affectation > Fiche Retour
Breadcrumbs::for('employes.affectation.ficheretour', function ($trail, $emp_id, $aff_id) {
    $trail->parent('employes.affectation.show', $emp_id, $aff_id);
    $trail->push('Fiche Retour', route('affectations.ficheretour', $aff_id));
});


/**
 * [Breadcrumbs Departements]
 *
 */
// Home > Departements
Breadcrumbs::for('departements', function ($trail) {
    $trail->parent('home');
    $trail->push('Departements', route('departements.index'));
});

// Home > Departements > Nouveau
Breadcrumbs::for('departements.create', function ($trail) {
    $trail->parent('departements');
    $trail->push('Nouveau', route('departements.create'));
});

// Home > Departements > [Departement]
Breadcrumbs::for('departements.show', function ($trail, $id) {
    $departement = Departement::findOrFail($id);
    $trail->parent('departements');
    $trail->push($departement->intitule, route('departements.show', $departement));
});

// Home > Departements > [Departement] > Modification
Breadcrumbs::for('departements.edit', function ($trail, $id) {
    $departement = Departement::findOrFail($id);
    $trail->parent('departements.show', $id);
    $trail->push('Modification', route('departements.edit', $departement));
});

// Home > Departements > [Departement] > Nouvelle Affectation
Breadcrumbs::for('departements.affectation.create', function ($trail, $id) {
    $departement = Departement::findOrFail($id);
    $trail->parent('departements.show', $id);
    $trail->push('Nouvelle Affectation', route('affectations.elemcreate',['Departement', $departement->id]));
});

// Home > Departements > [Departement] > Modification Affectation
Breadcrumbs::for('departements.affectation.edit', function ($trail, $dep_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('departements.show', $dep_id);
    $trail->push('Modification Affectation', route('affectations.edit', $aff_id));
});

// Home > Departements > [Departement] > Détails Affectation
Breadcrumbs::for('departements.affectation.show', function ($trail, $dep_id, $aff_id) {
    $aff = Affectation::findOrFail($aff_id);
    $trail->parent('departements.show', $dep_id);
    $trail->push('Détails Affectation: ' . $aff->objet, route('affectations.show', $aff_id));
});

// Home > Departements > [Departement] > Détails Affectation > Fiche Retour
Breadcrumbs::for('departements.affectation.ficheretour', function ($trail, $dep_id, $aff_id) {
    $trail->parent('departements.affectation.show', $dep_id, $aff_id);
    $trail->push('Fiche Retour', route('affectations.ficheretour', $aff_id));
});


/**
 * [Breadcrumbs Affectations]
 *
 */
// Home > Employes
Breadcrumbs::for('affectations', function ($trail) {
    $trail->parent('home');
    $trail->push('Affectations Articles', route('affectations.index'));
});


/**
 * [Breadcrumbs Fournisseurs]
 *
 */
// Home > Fournisseurs
Breadcrumbs::for('fournisseurs', function ($trail) {
    $trail->parent('home');
    $trail->push('Fournisseurs', route('fournisseurs.index'));
});

// Home > Fournisseurs > Nouveau
Breadcrumbs::for('fournisseurs.create', function ($trail) {
    $trail->parent('fournisseurs');
    $trail->push('Nouveau', route('fournisseurs.create'));
});

// Home > Fournisseurs > [Fournisseur]
Breadcrumbs::for('fournisseurs.show', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs');
    $trail->push($fournisseur->raison_sociale, route('fournisseurs.show', $fournisseur->id));
});

// Home > Fournisseurs > [Fournisseur] > Modification
Breadcrumbs::for('fournisseurs.edit', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs.show', $id);
    $trail->push('Modification', route('fournisseurs.edit', $fournisseur));
});

// Home > Fournisseurs > [Fournisseur] > Modification > e-mails
Breadcrumbs::for('fournisseurs.emails', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs.edit', $id);
    $trail->push('e-mails');
});

// Home > Fournisseurs > [Fournisseur] > Modification > Telephones
Breadcrumbs::for('fournisseurs.phonenums', function ($trail, $id) {
    $fournisseur = Fournisseur::findOrFail($id);
    $trail->parent('fournisseurs.edit', $id);
    $trail->push('Telephones');
});

/**
 * [Breadcrumbs Marques]
 *
 */
// Home > Marques
Breadcrumbs::for('marquearticles', function ($trail) {
    $trail->parent('home');
    $trail->push('Marques', route('marquearticles.index'));
});

// Home > Marques > Nouveau
Breadcrumbs::for('marquearticles.create', function ($trail) {
    $trail->parent('marquearticles');
    $trail->push('Nouveau', route('marquearticles.create'));
});

// Home > Marques > [Marque]
Breadcrumbs::for('marquearticles.show', function ($trail, $id) {
    $marquearticle = MarqueArticle::findOrFail($id);
    $trail->parent('marquearticles');
    $trail->push($marquearticle->nom, route('marquearticles.show', $marquearticle->id));
});

// Home > Marques > [Marque] > Modification
Breadcrumbs::for('marquearticles.edit', function ($trail, $id) {
    $marquearticle = MarqueArticle::findOrFail($id);
    $trail->parent('marquearticles.show', $id);
    $trail->push('Modification', route('marquearticles.edit', $marquearticle));
});


/**
 * [Breadcrumbs Fonctions]
 *
 */
// Home > Fonctions
Breadcrumbs::for('fonctionemployes', function ($trail) {
    $trail->parent('home');
    $trail->push('Fonctions', route('fonctionemployes.index'));
});

// Home > Fonctions > Nouveau
Breadcrumbs::for('fonctionemployes.create', function ($trail) {
    $trail->parent('fonctionemployes');
    $trail->push('Nouveau', route('fonctionemployes.create'));
});

// Home > Fonctions > [Fonction]
Breadcrumbs::for('fonctionemployes.show', function ($trail, $id) {
    $fonctionemploye = FonctionEmploye::findOrFail($id);
    $trail->parent('fonctionemployes');
    $trail->push($fonctionemploye->intitule, route('fonctionemployes.show', $fonctionemploye->id));
});

// Home > Fonctions > [Fonction] > Modification
Breadcrumbs::for('fonctionemployes.edit', function ($trail, $id) {
    $fonctionemploye = FonctionEmploye::findOrFail($id);
    $trail->parent('fonctionemployes.show', $id);
    $trail->push('Modification', route('fonctionemployes.edit', $fonctionemploye));
});



// Parametres
Breadcrumbs::for('parametres', function ($trail, $active_tab = null) {
    //$request_param = is_null($active_tab) ? '' : '&active_tab=' . $active_tab ;

    if (is_null($active_tab)) {
      $trail->push('Paramètres', route('parametres.index'));
    } else {
      $trail->push('Paramètres', route($active_tab));
    }

});

// Parametres > Statuts
Breadcrumbs::for('statuts', function ($trail) {
    $trail->parent('parametres');
    $trail->push('Statuts', route('etatarticles.index'));
});
// Parametres > Statuts > Nouveau
Breadcrumbs::for('statuts.create', function ($trail) {
    $trail->parent('statuts');
    $trail->push('Nouveau', route('statuts.create'));
});
// Parametres > Statuts > [Statut]
Breadcrumbs::for('statuts.show', function ($trail, $id) {
    $statut = Statut::findOrFail($id);
    $trail->parent('statuts');
    $trail->push($statut->libelle, route('statuts.show', $statut->id));
});
// Parametres > Statuts > [Statut] > Modification
Breadcrumbs::for('statuts.edit', function ($trail, $id) {
    $statut = Statut::findOrFail($id);
    $trail->parent('statuts.show', $id);
    $trail->push('Modification', route('statuts.edit', $statut));
});

// Parametres > EtatArticles
Breadcrumbs::for('etatarticles', function ($trail) {
    $trail->parent('parametres');
    $trail->push('Etats Article', route('etatarticles.index'));
});
// Parametres > EtatArticles > Nouveau
Breadcrumbs::for('etatarticles.create', function ($trail) {
    $trail->parent('etatarticles');
    $trail->push('Nouveau', route('etatarticles.create'));
});
// Parametres > EtatArticles > [EtatArticle]
Breadcrumbs::for('etatarticles.show', function ($trail, $id) {
    $etatarticle = EtatArticle::findOrFail($id);
    $trail->parent('etatarticles');
    $trail->push($etatarticle->libelle, route('etatarticles.show', $etatarticle->id));
});
// Parametres > EtatArticles > [EtatArticle] > Modification
Breadcrumbs::for('etatarticles.edit', function ($trail, $id) {
    $etatarticle = EtatArticle::findOrFail($id);
    $trail->parent('etatarticles.show', $id);
    $trail->push('Modification', route('etatarticles.edit', $etatarticle));
});

// Parametres > TypeAffectations
Breadcrumbs::for('typeaffectations', function ($trail) {
    $trail->parent('parametres');
    $trail->push('Types Affectation', route('typeaffectations.index'));
});
// Parametres > TypeAffectations > Nouveau
Breadcrumbs::for('typeaffectations.create', function ($trail) {
    $trail->parent('typeaffectations');
    $trail->push('Nouveau', route('typeaffectations.create'));
});
// Parametres > TypeAffectations > [TypeAffectation]
Breadcrumbs::for('typeaffectations.show', function ($trail, $id) {
    $typeaffectation = TypeAffectation::findOrFail($id);
    $trail->parent('typeaffectations');
    $trail->push($typeaffectation->libelle, route('typeaffectations.show', $typeaffectation->id));
});
// Parametres > TypeAffectations > [TypeAffectation] > Modification
Breadcrumbs::for('typeaffectations.edit', function ($trail, $id) {
    $typeaffectation = TypeAffectation::findOrFail($id);
    $trail->parent('typeaffectations.show', $id);
    $trail->push('Modification', route('typeaffectations.edit', $typeaffectation));
});

// Parametres > TypeMouvements
Breadcrumbs::for('typemouvements', function ($trail) {
    $trail->parent('parametres');
    $trail->push('Types Mouvement', route('typemouvements.index'));
});
// Parametres > TypeMouvements > Nouveau
Breadcrumbs::for('typemouvements.create', function ($trail) {
    $trail->parent('typemouvements');
    $trail->push('Nouveau', route('typemouvements.create'));
});
// Parametres > TypeMouvements > [TypeMouvement]
Breadcrumbs::for('typemouvements.show', function ($trail, $id) {
    $typemouvement = TypeMouvement::findOrFail($id);
    $trail->parent('typemouvements');
    $trail->push($typemouvement->libelle, route('typemouvements.show', $typemouvement->id));
});
// Parametres > TypeMouvements > [TypeMouvement] > Modification
Breadcrumbs::for('typemouvements.edit', function ($trail, $id) {
    $typemouvement = TypeMouvement::findOrFail($id);
    $trail->parent('typemouvements.show', $id);
    $trail->push('Modification', route('typemouvements.edit', $typemouvement));
});

// Parametres > EtatCommandes
Breadcrumbs::for('etatcommandes', function ($trail) {
    $trail->parent('parametres');
    $trail->push('Etats Commande', route('etatcommandes.index'));
});
// Parametres > EtatCommandes > Nouveau
Breadcrumbs::for('etatcommandes.create', function ($trail) {
    $trail->parent('etatcommandes');
    $trail->push('Nouveau', route('etatcommandes.create'));
});
// Parametres > EtatCommandes > [EtatCommande]
Breadcrumbs::for('etatcommandes.show', function ($trail, $id) {
    $etatcommande = EtatCommande::findOrFail($id);
    $trail->parent('etatcommandes');
    $trail->push($etatcommande->libelle, route('etatcommandes.show', $etatcommande->id));
});
// Parametres > EtatCommandes > [EtatCommande] > Modification
Breadcrumbs::for('etatcommandes.edit', function ($trail, $id) {
    $etatcommande = EtatCommande::findOrFail($id);
    $trail->parent('etatcommandes.show', $id);
    $trail->push('Modification', route('etatcommandes.edit', $etatcommande));
});

// Parametres > TypeDepartements
Breadcrumbs::for('typedepartements', function ($trail) {
    $trail->parent('parametres');
    $trail->push('Types Departement', route('typedepartements.index'));
});
// Parametres > TypeDepartements > Nouveau
Breadcrumbs::for('typedepartements.create', function ($trail) {
    $trail->parent('typedepartements');
    $trail->push('Nouveau', route('typedepartements.create'));
});
// Parametres > TypeDepartements > [TypeDepartement]
Breadcrumbs::for('typedepartements.show', function ($trail, $id) {
    $typedepartement = TypeDepartement::findOrFail($id);
    $trail->parent('typedepartements');
    $trail->push($typedepartement->intitule, route('typedepartements.show', $typedepartement->id));
});
// Parametres > TypeDepartements > [TypeDepartement] > Modification
Breadcrumbs::for('typedepartements.edit', function ($trail, $id) {
    $typedepartement = TypeDepartement::findOrFail($id);
    $trail->parent('typedepartements.show', $id);
    $trail->push('Modification', route('typedepartements.edit', $typedepartement));
});

/**
 * Corbeille
 *
 */
// Corbeille
Breadcrumbs::for('corbeille', function ($trail) {
    $trail->push('Corbeille', route('recyclebin.index'));
});

// Corbeille > [Trash]
Breadcrumbs::for('corbeille.show', function ($trail, $id) {
    $trash = RecycleBin::findOrFail($id);
    $trail->parent('corbeille');
    $trail->push($trash->object_model_name);
    $trail->push($trash->object_denomination, route('recyclebin.show', $trash->id));
});
