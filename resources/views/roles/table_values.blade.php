<td>{{ $currval->name }}</td>
<td>{{ $currval->description }}</td>
<td class="text-left">
@if(isset($currval))
  @if(!empty($currval->getAllPermissions()))
    @foreach($currval->getAllPermissions() as $v)
      @include('permissions.display', ['perm'=>$v])
    @endforeach
    @endif
  @endif
</td>
