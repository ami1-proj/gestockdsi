@extends('layouts.app')

@section('page')
  @include('layouts._button_index', ['canlist' => App\Affectation::canlist(), 'index_route' => \App\Affectation::$route_index, 'model' => $affectation, 'title' => 'Affectations'])
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_edit'],$elem_arr['elem']->id,$affectation) }}
@endsection

@section('more_css')
    @include('roles.articles_css')
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Modification Affectation {{ $elem_arr['type'] }}</h4>

          <p class="text-muted m-b-30 font-14">Modifer l affection <code class="highlighter-rouge"><strong>{{ $affectation->objet }}</strong></code>  assignee {{ $elem_arr['article'] }}  {{ $elem_arr['type'] }} <strong>{{ $elem_arr['elem']->denomination }}</strong>.</p>

          <form action="{{ route('affectations.update', [$affectation->id]) }}" method="POST">
          @method('PUT')

          <div class="row">

            @include('affectations.fields')

          </div>

          @csrf

          <div class="form-group row">
            <div class="col-sm-3">
              <button name="action" value="valider-affectation" type="submit" class="btn btn-primary">Valider</button>
              <a href="{{ action($elem_arr['showController'], [$elem_arr['elem']->id]) }}" class="btn btn-secondary">Annuler</a>
            </div>
          </div>

          <input type="hidden" name="elem_id" value="{{$elem_arr['elem']->id}}"/>

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

@section('more_js')
    @include('roles.articles_js')
@endsection
