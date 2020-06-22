<td>{{ $currval->intitule }}</td>
<td>{{ $currval->employeResponsable ? $division->employeResponsable->nom_complet : '' }}</td>
<td>{{ $currval->zone->intitule }}</td>
<td>{{ $currval->statut->libelle }}</td>