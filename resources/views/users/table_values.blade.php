<td class="text-left">{{ $currval->name ?? ''  }}</td>
<td class="text-left">{{ $currval->email ?? '' }}</td>
<td class="text-left">{{ $currval->username ?? '' }}</td>
<td>
    <input disabled class="toggle-class" type="checkbox" data-onstyle="outline-info" data-offstyle="outline-warning" data-toggle="toggle" data-on="Oui" data-off="Non" data-size="xs" {{ $currval->is_local == '1' ? 'checked' : '' }}>
</td>
<td>
    <input disabled class="toggle-class" type="checkbox" data-onstyle="outline-info" data-offstyle="outline-warning" data-toggle="toggle" data-on="Oui" data-off="Non" data-size="xs" {{ $currval->is_ldap == '1' ? 'checked' : '' }}>
</td>
<td class="text-left">
@if(isset($currval))
  @if(!empty($currval->getRoleNames()))
    @foreach($currval->getRoleNames() as $v)
      <label class="badge badge-success">{{ $v }}</label>
    @endforeach
    @endif
  @endif
</td>
