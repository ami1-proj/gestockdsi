<td>{{ $currval->intitule }}</td>
<td>{{ $currval->employeResponsable ? $currval->employeResponsable->nom_complet : '' }}</td>

<td>{{ $currval->statut->libelle }}</td>