<td>{{ $currval->nom_complet }}</td>
<td>{{ $currval->matricule }}</td>
<td>
  <a href="{{ $currval->fonction ? action('FonctionEmployeController@show', $currval->fonction) : '#' }}">{{ $currval->fonction ? $currval->fonction->intitule : '' }}</a>
</td>
<td class="">
  <a href="{{ $currval->departement ? action('DepartementController@show', $currval->departement) : '#' }}">{{ $currval->departement ? $currval->departement->chemin_complet : '' }}</a>
</td>
<td style="width:1px; whithe-space:nowrap">
  <span class="badge label-primary">{{ $currval->phonenums->first() ? $currval->phonenums->first()->numero : '' }}</span>
</td>
<td style="width:1px; whithe-space:nowrap">
  <span class="badge label-primary">{{ $currval->adresseemails->first() ? $currval->adresseemails->first()->email : '' }}</span>
</td>
