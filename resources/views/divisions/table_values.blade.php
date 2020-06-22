<td>{{ $currval->intitule }}</td>
<td>{{ $currval->employeResponsable ? $division->employeResponsable->nom_complet : '' }}</td>
<td>{{ $currval->direction->intitule }}</td>
<td>{{ $currval->statut->libelle }}</td>