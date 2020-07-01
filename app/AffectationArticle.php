<?php

namespace App;

// use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AffectationArticle
 * @package App
 *
 * @property integer $id
 * @property \Illuminate\Support\Carbon $date_debut
 * @property string|null $details_debut
 * @property \Illuminate\Support\Carbon|null $date_fin
 * @property string|null $details_fin
 * @property integer|null $article_id
 * @property integer|null $type_mouvement_id
 * @property integer|null $affectation_id
 * @property integer|null $prev_affectationarticle_id
 * @property integer|null $next_affectationarticle_id
 * @property integer|null $stock_emplacement_id
 * @property integer|null $statut_id
 * @property string|null $tags
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class AffectationArticle extends Model
{
    public $incrementing = true;
    protected $table = 'affectation_article';

    protected $guarded = [];

    public function article() {
        return $this->belongsTo('App\Article', 'article_id');
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
