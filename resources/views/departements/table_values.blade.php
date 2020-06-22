<td>{{ $currval->intitule }}</td>
<td>
  <a href="{{ $currval->parent ? action('DepartementController@show', $currval->parent) : '#' }}">{{ $currval->parent ? $currval->parent->chemin_complet : '' }}</a>
</td>
<td>
<a href="{{ $currval->employeResponsable ? action('EmployeController@show', $currval->employeResponsable) : '#' }}">{{ $currval->employeResponsable ? $currval->employeResponsable->nom_complet : '' }}</a>
</td>
<td>{{ $currval->typedepartement->intitule }}</td>
