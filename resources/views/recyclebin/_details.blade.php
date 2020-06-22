@if(isset($currval->deleted_at) && (!(is_null($currval->deleted_at))))
  <dt class="col-sm-3">Date Suppression</dt>
  <dd class="col-sm-9">{{ date('d-m-Y H:i:s', strtotime($currval->deleted_at)) }}</dd>
@endif
