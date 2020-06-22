@can('role-edit')
  <button type="button" class="btn btn-outline-primary waves-effect waves-light">
    <a href="{{ action('RoleController@edit', ['role' => $role]) }}" alt="Modifer" title="Edit">
      Modifier
    </a>
  </button>
@endcan
