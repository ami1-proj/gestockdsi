@if ($perm->level == 1)
  <label class="badge badge-danger">{{ $perm->name }}</label>
@else
  @if ($perm->level == 2)
    <label class="badge badge-warning">{{ $perm->name }}</label>
  @else
    @if ($perm->level == 3)
      <label class="badge badge-primary">{{ $perm->name }}</label>
    @else
      <label class="badge badge-success">{{ $perm->name }}</label>
    @endif
  @endif
@endif
