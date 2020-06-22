<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppPermission extends Model
{
    public static $list = [
      'Permission' => [
        'select-all' => ['permission-select-all', 1],
      ],

      /**
       * Sécurité
       */

      // Role
      'RoleCustom' => [
        'list' => ['role-list', 4],
        'create' => ['role-create', 2],
        'edit' => ['role-edit', 2],
        'delete' => ['role-delete', 1],
        'change_statut' => ['role-change_statut', 2],
        'restore_trash' => ['role-restore_trash', 2],
        'delete_trash' => ['role-delete_trash', 2],
      ],
      // User
      'User' => [
        'list' => ['user-list', 4],
        'create' => ['user-create', 2],
        'edit' => ['user-edit', 2],
        'delete' => ['user-delete', 1],
        'change_statut' => ['user-change_statut', 2],
        'restore_trash' => ['user-restore_trash', 2],
        'delete_trash' => ['user-delete_trash', 2],
      ],
      // Statut`
      'Statut' => [
        'list' => ['statut-list', 4],
        'create' => ['statut-create', 1],
        'edit' => ['statut-edit', 1],
        'delete' => ['statut-delete', 1],
        'restore_trash' => ['statut-restore_trash', 1],
        'delete_trash' => ['statut-delete_trash', 1],
      ],
      // Corbeille
      'RecycleBin' => [
        'list' => ['trash-list', 4],
        'create' => ['trash-create', 2],
        'edit' => ['trash-edit', 2],
        'delete' => ['trash-delete', 1],
        'restore' => ['trash-restore', 2],
      ],
      /**
       * Paramètres
       */
      'Parametre' => [
        'list' => ['parametre-list', 1],
      ],
      // Etat commande
      'EtatCommande' => [
        'list' => ['etat_commande-list', 4],
        'create' => ['etat_commande-create', 1],
        'edit' => ['etat_commande-edit', 1],
        'delete' => ['etat_commande-delete', 1],
        'change_statut' => ['etat_commande-change_statut', 1],
        'restore_trash' => ['etat_commande-restore_trash', 1],
        'delete_trash' => ['etat_commande-delete_trash', 1],
      ],
      // Type affectation
      'TypeAffectation' => [
        'list' => ['type_affectation-list', 4],
        'create' => ['type_affectation-create', 1],
        'edit' => ['type_affectation-edit', 1],
        'delete' => ['type_affectation-delete', 1],
        'change_statut' => ['type_affectation-change_statut', 1],
        'restore_trash' => ['type_affectation-restore_trash', 1],
        'delete_trash' => ['type_affectation-delete_trash', 1],
      ],
      // Type Departement
      'TypeDepartement' => [
        'list' => ['type_departement-list', 4],
        'create' => ['type_departement-create', 1],
        'edit' => ['type_departement-edit', 1],
        'delete' => ['type_departement-delete', 1],
        'change_statut' => ['type_departement-change_statut', 1],
        'restore_trash' => ['type_departement-restore_trash', 1],
        'delete_trash' => ['type_departement-delete_trash', 1],
      ],
      // Type mouvement
      'TypeMouvement' => [
        'list' => ['type_mouvement-list', 4],
        'create' => ['type_mouvement-create', 1],
        'edit' => ['type_mouvement-edit', 1],
        'delete' => ['type_mouvement-delete', 1],
        'change_statut' => ['type_mouvement-change_statut', 1],
        'restore_trash' => ['type_mouvement-restore_trash', 1],
        'delete_trash' => ['type_mouvement-delete_trash', 1],
      ],
      /**
       * Autres
       */

      // Affectation
      'Affectation' => [
        'list' => ['affectation-list', 4],
        'create' => ['affectation-create', 3],
        'edit' => ['affectation-edit', 3],
        'delete' => ['affectation-delete', 1],
        'change_statut' => ['affectation-change_statut', 2],
        'restore_trash' => ['affectation-restore_trash', 2],
        'delete_trash' => ['affectation-delete_trash', 2],
        'print' => ['affectation-print', 2],
      ],
      // Article
      'Article' => [
        'list' => ['article-list', 4],
        'create' => ['article-create', 3],
        'edit' => ['article-edit', 3],
        'delete' => ['article-delete', 1],
        'affecter' => ['article-affecter', 3],
        'change_statut' => ['article-change_statut', 2],
        'restore_trash' => ['article-restore_trash', 2],
        'delete_trash' => ['article-delete_trash', 2],
      ],
      // Commande
      'Commande' => [
        'list' => ['commande-list', 4],
        'create' => ['commande-create', 3],
        'edit' => ['commande-edit', 3],
        'delete' => ['commande-delete', 1],
        'traiter' => ['commande-traiter', 3],
        'change_statut' => ['commande-change_statut', 2],
        'restore_trash' => ['commande-restore_trash', 2],
        'delete_trash' => ['commande-delete_trash', 2],
      ],
      // Departement
      'Departement' => [
        'list' => ['departement-list', 4],
        'create' => ['departement-create', 3],
        'edit' => ['departement-edit', 3],
        'delete' => ['departement-delete', 1],
        'change_statut' => ['departement-change_statut', 2],
        'restore_trash' => ['departement-restore_trash', 2],
        'delete_trash' => ['departement-delete_trash', 2],
      ],
      // Employe
      'Employe' => [
        'list' => ['employe-list', 4],
        'create' => ['employe-create', 3],
        'edit' => ['employe-edit', 3],
        'delete' => ['employe-delete', 1],
        'change_statut' => ['employe-change_statut', 2],
        'restore_trash' => ['employe-restore_trash', 2],
        'delete_trash' => ['employe-delete_trash', 2],
      ],
      // Etat article
      'EtatArticle' => [
        'list' => ['etat_article-list', 4],
        'create' => ['etat_article-create', 3],
        'edit' => ['etat_article-edit', 3],
        'delete' => ['etat_article-delete', 1],
        'change_statut' => ['etat_article-change_statut', 2],
        'restore_trash' => ['etat_article-restore_trash', 2],
        'delete_trash' => ['etat_article-delete_trash', 2],
      ],
      // Fonction employe
      'FonctionEmploye' => [
        'list' => ['fonction_employe-list', 4],
        'create' => ['fonction_employe-create', 3],
        'edit' => ['fonction_employe-edit', 3],
        'delete' => ['fonction_employe-delete', 1],
        'change_statut' => ['fonction_employe-change_statut', 2],
        'restore_trash' => ['fonction_employe-restore_trash', 2],
        'delete_trash' => ['fonction_employe-delete_trash', 2],
      ],
      // Fournisseur
      'Fournisseur' => [
        'list' => ['fournisseur-list', 4],
        'create' => ['fournisseur-create', 3],
        'edit' => ['fournisseur-edit', 3],
        'delete' => ['fournisseur-delete', 1],
        'change_statut' => ['fournisseur-change_statut', 2],
        'restore_trash' => ['fournisseur-restore_trash', 2],
        'delete_trash' => ['fournisseur-delete_trash', 2],
      ],
      // Marque article
      'MarqueArticle' => [
        'list' => ['marque_article-list', 4],
        'create' => ['marque_article-create', 3],
        'edit' => ['marque_article-edit', 3],
        'delete' => ['marque_article-delete', 1],
        'change_statut' => ['marque_article-change_statut', 2],
        'restore_trash' => ['marque_article-restore_trash', 2],
        'delete_trash' => ['marque_article-delete_trash', 2],
      ],
      // Stock
      'Stock' => [
        'list' => ['stock-list', 4],
        'create' => ['stock-create', 3],
        'edit' => ['stock-edit', 3],
        'delete' => ['stock-delete', 1],
        'change_statut' => ['stock-change_statut', 2],
        'restore_trash' => ['stock-restore_trash', 2],
        'delete_trash' => ['stock-delete_trash', 2],
      ],
      // Stock Lieu
      'StockLieu' => [
        'list' => ['stock_lieu-list', 4],
        'create' => ['stock_lieu-create', 3],
        'edit' => ['stock_lieu-edit', 3],
        'delete' => ['stock_lieu-delete', 1],
        'change_statut' => ['stock_lieu-change_statut', 2],
        'restore_trash' => ['stock_lieu-restore_trash', 2],
        'delete_trash' => ['stock_lieu-delete_trash', 2],
      ],
      // Stock emplacement
      'StockEmplacement' => [
        'list' => ['stock_emplacement-list', 4],
        'create' => ['stock_emplacement-create', 3],
        'edit' => ['stock_emplacement-edit', 3],
        'delete' => ['stock_emplacement-delete', 1],
        'change_statut' => ['stock_emplacement-change_statut', 2],
        'restore_trash' => ['stock_emplacement-restore_trash', 2],
        'delete_trash' => ['stock_emplacement-delete_trash', 2],
      ],
      // Type article
      'TypeArticle' => [
        'list' => ['type_article-list', 4],
        'create' => ['type_article-create', 3],
        'edit' => ['type_article-edit', 3],
        'delete' => ['type_article-delete', 1],
        'change_statut' => ['type_article-change_statut', 2],
        'restore_trash' => ['type_article-restore_trash', 2],
        'delete_trash' => ['type_article-delete_trash', 2],
      ],
    ];
}
