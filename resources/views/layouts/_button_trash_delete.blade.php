@can($candeletetrash)
  <a class="btn btn-outline-danger waves-effect waves-light btn-sm"  href="#" onclick="if(confirm('Etes-vous sur de vouloir supprimer DEFINITIVEMENT?')) {event.preventDefault() ; document.getElementById('buttondestroy-form').submit();}">
    Supprimer définitivement
  </a>

  <form id="buttondestroy-form" action="{{ action('RecycleBinController@destroy', $recycle_bin_id) }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
  </form>
@endcan
