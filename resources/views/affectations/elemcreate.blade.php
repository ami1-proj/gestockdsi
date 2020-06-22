@extends('layouts.app')

@section('page')
  Affectations
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_create'],$elem_arr['breadcrumb_param']) }}
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Nouvelle Affectation {{ $elem_arr['type'] }}</h4>
          <p class="text-muted m-b-30 font-14">Créer une nouvelle affectation pour <code class="highlighter-rouge">{{ $elem_arr['elem']->denomination }}</code>.</p>


          <form action="{{ route('affectations.elemstore', [$type_affectation->tags,$elem_arr['elem']->id]) }}" method="POST">

          <div class="row">

            @include('affectations.fields')

          </div>

          @csrf

            <div class="form-group row">
                <div class="col-sm-3">
                    <button name="action" value="valider-affectation" class="btn btn-primary">Valider</button>
                    <a href="{{ action($elem_arr['showController'], [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Annuler</a>
                </div>
              </div>

          </form>


      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script type="text/javascript">

  function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text" || node.type=="search"))  {return false;}
  }

  document.onkeypress = stopRKey;

</script>
@endsection
