<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Statut;
use App\StockLieu;


class Stock extends AppBaseModel
{
    use SoftDeletes;
    protected $guarded = [];

    public static $model_name = 'Stock';

    public static $view_folder = 'stocks';
    public static $view_fields = 'stocks.fields';
    public static $view_table_values = 'stocks.table_values';
    public static $view_table_headers = 'stocks.table_headers';
    public static $view_morecontrols = [];
    public static $view_moreforms = [];

    public static $var_name_single = 'stock';
    public static $unique_fields = [];

    public static $det_sing = 'le';
    public static $det_plu = 'les';
    public static $det_contr_sing = 'du';
    public static $det_contr_plu = 'des';

    public static $title_sing = 'stock';
    public static $title_plu = 'stock';

    public static $route_index = 'StockController@index';
    public static $route_create = 'StockController@create';
    public static $route_store = 'StockController@store';
    public static $route_show = 'StockController@show';
    public static $route_edit = 'StockController@edit';
    public static $route_update = 'StockController@update';
    public static $route_destroy = 'StockController@destroy';

    public static $breadcrumb_index = 'stocks';
    public static $breadcrumb_create = 'stocks.create';
    public static $breadcrumb_show = 'stocks.show';
    public static $breadcrumb_edit = 'stocks.edit';

    public static $denomination_field = 'nom';

    public function getDenominationAttribute() {
        return $this->{self::$denomination_field};
    }

    public function scopeSearch($query, $q) {
      if ($q == null) return $query;

      $statuts = Statut::search($q)->get()->pluck('id')->toArray();
      $stocklieus = StockLieu::search($q)->get()->pluck('id')->toArray();

      return $query
        ->where('nom', 'LIKE', "%{$q}%")
        ->orWhereIn('statut_id', $statuts)
        ->orWhereIn('lieu_id', $stocklieus);
    }

    /**
     * Renvoie le Statut du Stock.
     */
    public function statut() {
        return $this->belongsTo('App\Statut');
    }

    /**
     * Renvoie le lieu (StockLieu) du Stock.
     */
    public function stockLieu() {
        return $this->belongsTo('App\StockLieu','lieu_id');
    }

    public function affectations() {
        return $this->hasMany('App\Affectation', 'stock_id')
          ->whereNull('date_fin');
    }

}
