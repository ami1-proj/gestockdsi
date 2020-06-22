@extends('layouts.app')

@section('page')
  @include('layouts._button_index', ['canlist' => \App\RecycleBin::canlist(), 'index_route' => 'RecycleBinController@index', 'model' => $trashe->id, 'title' => 'corbeille'])
@endsection

@section('buttons')
  @include('layouts._button_delete_trash', ['candeletetrash' => $trashe->object_class_name::candelete_trash(), 'model' => $trashe->id])
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('corbeille.show',$trashe->id) }}
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

  <div class="row">
    <div class="col-12">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">Détails</h4>
            <p class="text-muted m-b-30 font-14">Détails <code class="highlighter-rouge"><strong>Suppression</strong></code>.</p>

            <dl class="row">
                <dt class="col-sm-3">Id suppression</dt>
                <dd class="col-sm-9">{{ $trashe->id }}</dd>

                <dt class="col-sm-3">Type objet</dt>
                <dd class="col-sm-9">{{ $trashe->object_model_name }}</dd>

                <dt class="col-sm-3">Id objet</dt>
                <dd class="col-sm-9">{{ $trashe->object_id }}</dd>

                <dt class="col-sm-3">Dénomination</dt>
                <dd class="col-sm-9">{{ $trashe->object_denomination }}</dd>

                <dt class="col-sm-3">Date suppression</dt>
                <dd class="col-sm-9">{{ date('d-m-Y H:i:s', strtotime($trashe->created_at)) }}</dd>

            </dl>

        </div>
      </div>
    </div>
  </div>
@endsection
