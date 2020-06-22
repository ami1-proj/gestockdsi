<td>{{ $currval->objet }}</td>
<td>{{ $currval->typeAffectation->tags ?? '' }}</td>
<td>
  <a href="{{ action($currval->typeAffectation->object_class_name::$route_show, $currval->beneficiaire_id) }}">
    {{ $currval->beneficiaire->denomination ?? '' }}
  </a>
</td>
<td>
  @if($currval->date_fin)
  <span class="badge badge-warning">terminée le: {{ date('d-m-Y H:i:s', strtotime($currval->date_fin)) }}</span>
  @else
  <span class="badge badge-primary">en cours</span>
  @endif
</td>
