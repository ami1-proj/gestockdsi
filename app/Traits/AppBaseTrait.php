<?php

namespace App\Traits;

use App\Statut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\RecycleBin;
use App\TypeAffectation;

trait AppBaseTrait {

    public function getIsActifAttribute() {
        return ($this->statut_id == Statut::actif()->first()->id);
    }

  /**
   * Renvoie un tableau contenant le chemin complet[0] et le nom[1] de la classe qui implémente ce Trait
   * @return array Le tableau
   */
  private static function getCallerArray() {
    $caller_class_full = get_called_class();
    // On retire le chemin (App\\) du nom de la classe
    $caller_class = str_replace("App\\", "", $caller_class_full);
    return [$caller_class_full,$caller_class];
  }

  /**
   * Obtient le tableau static $view_attributes_array défini dans la classe implémentante
   * @param  [type] $caller_class la classe implémentante
   * @return [type]               Le tableau
   */
  private static function getViewAttributesRaw($caller_class) {
    // return $caller_class::$view_attributes_array;
    $type_affectation = TypeAffectation::forClass($caller_class)->first();
    $affectation_tag = $type_affectation ? $type_affectation->tags : '';

    return [
      'title' => $caller_class::$title_plu,
      'modeltype' => $caller_class::$det_contr_sing . ' ' . ucfirst($caller_class::$title_sing),
      'index_route' => $caller_class::$route_index,
      'create_route' => $caller_class::$route_create,
      'store_route' => $caller_class::$route_store,
      'show_route' => $caller_class::$route_show,
      'edit_route' => $caller_class::$route_edit,
      'update_route' => $caller_class::$route_update,
      'destroy_route' => $caller_class::$route_destroy,
      'table_values' => $caller_class::$view_table_values,
      'table_headers' => $caller_class::$view_table_headers,
      'affectation_tag' => $affectation_tag,
    ];
  }

  /**
   * Retourne le tableau des Permissions du model implémentant
   * @param  [type] $caller_class la classe implémentante
   * @return [type]               Le tableau de Permissions
   */
  private static function getModelPermissions($caller_class) {
    return [
      'cancreateaffectation' => $caller_class::cancreate(),
      'canchangestatut' => $caller_class::canchange_statut(),
      'canlist' => $caller_class::canlist(),
      'cancreate' => $caller_class::cancreate(),
      'canedit' => $caller_class::canedit(),
      'candelete' => $caller_class::candelete(),
      'candeletetrash' => $caller_class::candelete_trash(),
      'canrestoretrash' => $caller_class::canrestore_trash(),
      'canprint' => $caller_class::canprint(),
    ];
  }

  /**
   * Merge et retourne le tableau de base pour la vue
   * @param  [type] $caller_array tableau contenant les informations de la classe implémentante
   * @param  [type] $array_raw    tableau $view_attributes_array de la classe implémentante
   * @return [type]               Le tableau mergé
   */
  private static function getAttributesRawMerged($caller_array,$array_raw) {
    $array_permissions = self::getModelPermissions($caller_array[0]);
    $attributes_raw = $array_raw;//['raw'];
    $attributes_raw += $array_permissions;
    $attributes_raw['table_name'] = with(New $caller_array[0])->getTable();

    return $attributes_raw;
  }

  /**
   * Retourne le tableau contenant les variables necessaires a la construction de la vue index
   * @param  [type] $listvalues liste des valeurs a afficher dans la vue index
   * @return [type]             le tableau de variables
   */
  public static function view_attributes_index($listvalues) {

    $caller_array = self::getCallerArray();
    $array_raw = self::getViewAttributesRaw($caller_array[0]);

    $attributes_array = self::getAttributesRawMerged($caller_array, $array_raw);
    $attributes_array['listvalues'] = $listvalues;
    $attributes_array += [
      'breadcrumb_title' => $caller_array[0]::$breadcrumb_index,
      'breadcrumb_param' => '',
    ];
    $attributes_array += [
      'from_index_create' => isset($caller_array[0]::$from_index_create) ? $caller_array[0]::$from_index_create : true,
    ];

    return $attributes_array;
  }

  /**
   * Retourne le tableau contenant les variables necessaires a la construction de la vue create
   * @param  [type] $model objet du model
   * @return [type]        le tableau traité
   */
  public static function view_attributes_create($model) {

    $caller_array = self::getCallerArray();
    $array_raw = self::getViewAttributesRaw($caller_array[0]);

    $attributes_array = self::getAttributesRawMerged($caller_array, $array_raw);
    $attributes_array['model'] = $model;
    $attributes_array += [
      'breadcrumb_title' => $caller_array[0]::$breadcrumb_create,
      'breadcrumb_param' => '',
      'model_fields' => $caller_array[0]::$view_fields,
      'morecontrols' => $caller_array[0]::$view_morecontrols,
      'moreforms' => $caller_array[0]::$view_moreforms,
    ];

    return $attributes_array;
  }

  /**
   * Retourne le tableau contenant les variables necessaires a la construction de la vue edit
   * @param  [type] $model objet model a éditer
   * @return [type]        Le tableau de variables
   */
  public static function view_attributes_edit($model) {

    $caller_array = self::getCallerArray();
    $array_raw = self::getViewAttributesRaw($caller_array[0]);

    $attributes_array = self::getAttributesRawMerged($caller_array, $array_raw);
    $attributes_array['model'] = $model;
    $attributes_array['modelname'] = $model->{$caller_array[0]::$denomination_field};
    $attributes_array += [
      'breadcrumb_title' => $caller_array[0]::$breadcrumb_edit,
      'model_fields' => $caller_array[0]::$view_fields,
      'morecontrols' => $caller_array[0]::$view_morecontrols,
      'moreforms' => $caller_array[0]::$view_moreforms,
    ];
    $attributes_array['breadcrumb_param'] = $model->id;

    return $attributes_array;
  }

  /**
   * Retourne le tableau contenant les variables necessaires a la construction de la vue show
   * @param  [type] $model objet model a afficher
   * @return [type]        le tableau traité
   */
  public static function view_attributes_show($model) {

    $caller_array = self::getCallerArray();
    $array_raw = self::getViewAttributesRaw($caller_array[0]);

    $attributes_array = self::getAttributesRawMerged($caller_array, $array_raw);
    $attributes_array['model'] = $model;
    $attributes_array['modelname'] = $model->{$caller_array[0]::$denomination_field};
    $attributes_array += [
      'breadcrumb_title' => $caller_array[0]::$breadcrumb_show,
    ];

    // Show a partir de la Corbeille
    if ($model->isDeleted($model)) {
      $trash = RecycleBin::where('object_class_name', $caller_array[0])->where('object_id', $model->id)->first();
      $attributes_array['breadcrumb_title'] = 'corbeille.show';
      $attributes_array['breadcrumb_param'] = $trash->id;

      $attributes_array['title'] = 'corbeille';
      $attributes_array['index_route'] = 'RecycleBinController@index';
    } else {
      $attributes_array['breadcrumb_param'] = $model->id;
    }

    return $attributes_array;
  }
}
