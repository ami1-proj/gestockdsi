@can($candeletetrash)
  <a class="btn btn-outline-success waves-effect waves-light btn-sm"  href="#" onclick="if(confirm('Etes-vous sur de vouloir restaurer?')) {event.preventDefault() ; document.getElementById('buttonrestore-form').submit();}">
    Restaurer
  </a>

  <form id="buttonrestore-form" action="{{ action('RecycleBinController@restore', $recycle_bin_id) }}" method="POST" style="display: none;">
    @csrf
  </form>
@endcan
