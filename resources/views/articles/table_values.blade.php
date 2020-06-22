<td>{{ $currval->reference }}</td>
<td>{{ $currval->taille }}</td>
<td>
  <a href="{{ $currval->typeArticle ? action('TypeArticleController@show', $currval->typeArticle) : '#' }}">{{ $currval->typeArticle->libelle}}</a>
</td>
<td>
  <a href="{{ $currval->fournisseur ? action('FournisseurController@show', $currval->fournisseur) : '#' }}">{{ $currval->fournisseur->raison_sociale ?? ''}}</a>
</td>
<td>
  <a href="{{ $currval->marqueArticle ? action('MarqueArticleController@show', $currval->marqueArticle) : '#' }}">{{ $currval->marqueArticle->nom ?? '' }}</a>
</td>
<td>{{ $currval->etatArticle->libelle ?? '' }}</td>
<td>
  @if($currval->situation()->typeAffectation->tags == 'Stock')
  {{ $currval->situation()->typeAffectation->libelle ?? '' }}
  @else
  <a href="{{ action($currval->situation()->typeAffectation->object_class_name::$route_show, $currval->situation()->beneficiaire_id) }}">
    {{ $currval->situation()->typeAffectation->libelle ?? '' }}
  </a>
  @endif
</td>
