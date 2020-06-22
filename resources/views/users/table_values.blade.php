<td class="text-left">{{ $currval->name ?? ''  }}</td>
<td class="text-left">{{ $currval->email ?? '' }}</td>
<td class="text-left">
@if(isset($currval))
  @if(!empty($currval->getRoleNames()))
    @foreach($currval->getRoleNames() as $v)
      <label class="badge badge-success">{{ $v }}</label>
    @endforeach
    @endif
  @endif
</td>
