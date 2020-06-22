<?php

namespace App;

// use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;


class AffectationArticle extends Model
{
    public $incrementing = true;
    protected $table = 'affectation_article';

    protected $guarded = [];

    public function article() {
        return $this->belongsTo('App\Article');
    }

    public function affectation()
    {
        return $this->belongsTo('App\Affectation');
    }

    public function typemouvement()
    {
        return $this->belongsTo('App\TypeMouvement','type_mouvement_id');
    }

    public function stockemplacement()
    {
      return $this->belongsTo('App\StockEmplacement', 'stock_emplacement_id');
    }

    public function prev_affectationarticle() {
        return $this->belongsTo('App\Article', 'prev_affectationarticle_id');
    }

    public function next_affectationarticle() {
        return $this->belongsTo('App\AffectationArticle', 'next_affectationarticle_id');
    }

    public function terminer($details_fin)
    {
        $this->date_fin = now();
        $this->details_fin = $details_fin;
        $this->save();
    }
}
