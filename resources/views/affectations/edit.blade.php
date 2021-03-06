@extends('layouts.app')

@section('page')
  @include('layouts._button_index', ['canlist' => App\Affectation::canlist(), 'index_route' => \App\Affectation::$route_index, 'model' => $affectation, 'title' => 'Affectations'])
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_edit'],$elem_arr['elem']->id,$affectation) }}
@endsection

@section('css')
    @include('affectations.articles_css')
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

          @include('affectations.fields')
          @include('affectations.articles_control')

          @csrf

          <div class="form-group row">
              <div>
                  @can(App\Affectation::canedit())
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                  @endcan
                  <button type="reset" class="btn btn-success waves-effect waves-light">Reset</button>
                  <a href="{{ route('affectations.index') }}" class="btn btn-secondary waves-effect m-l-5">Annuler</a>
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
    @include('affectations.articles_js')
@endsection
