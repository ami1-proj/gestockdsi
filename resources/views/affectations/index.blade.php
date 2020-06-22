@extends('layouts.app')

@section('page')

@endsection

@section('buttons')

@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('affectations') }}
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Affectations</h4>
          <p class="text-muted m-b-30 font-14">Liste de toutes les <code class="highlighter-rouge">Affectations</code> du Système.</p>

          <div class="row">
            @include('layouts.message')
          </div>

          <!-- Panel de recherche -->
          <div class="row">
            @include('layouts.recherche_panel', ['index_route' => \App\Affectation::$route_index])
          </div>
          <!-- Fin Panel de recherche -->

          <div class="row">

            <table class="table table-hover table-sm">
              <thead class="thead-default">
                  <tr>
                      <th class="font-weight-bold">#</th>
                      @include('affectations.table_headers')
                      <th class="font-weight-bold">Date Creation</th>
                      <th class="font-weight-bold">Statut</th>
                      <th class="font-weight-bold text-center" colspan="3">Actions</th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($affectations as $currval)
                  <tr>
                    <td class="font-weight-bold text-left">{{ $currval->id }}</td>
                    @include('affectations.table_values', ['currval' => $currval])
                    <td class="text-left">{{ date('d-m-Y H:i:s', strtotime($currval->created_at)) }}</td>

                    <td class="text-left">
                        <input {{ Auth::user()->can(\App\Affectation::canchange_statut()) ? '' : 'disabled' }} data-id="{{$currval->id}}" data-tablename="{{ $currval->getTable() }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $currval->statut->code == 'actif' ? 'checked' : '' }}>
                    </td>

                    <!-- ACTIONS -->

                    <td style="width: 10px;">
                      <a href="{{ action(\App\Affectation::$route_show, $currval) }}" alt="Détails" title="Details">
                        <i class="fa fa-eye" style="color:green"></i>
                      </a>
                    </td>

                    <td style="width: 10px;">
                      @can(\App\Affectation::canedit())
                        <a style="{{ $currval->date_fin ? 'pointer-events: none; cursor: default; text-decoration: none; color: grey;' : '' }}" href="{{ action(\App\Affectation::$route_edit, $currval) }}" alt="Modifer" title="Edit">
                          <i class="ti-pencil-alt"></i>
                        </a>
                      @endcan
                    </td>

                    <td style="width: 10px;">
                      @can(\App\Affectation::candelete())
                        <a style="{{ $currval->date_fin ? 'pointer-events: none; cursor: default; text-decoration: none;' : '' }}" href="#" onclick="if(confirm('Etes-vous sur de vouloir supprimer?')) {event.preventDefault(); document.getElementById('index_destroy-form-{{ $currval->id }}').submit();}">
                          <i class="ti-trash" style="{{ $currval->date_fin ? 'color: grey;' : 'color: red;' }}"></i>
                        </a>
                        <form id="index_destroy-form-{{ $currval->id }}" action="{{ action(\App\Affectation::$route_destroy, $currval->id) }}" method="POST" style="display: none;">
                          @method('DELETE')
                          @csrf
                          <input type="hidden" value="{{ $currval->id }}" name="id">
                        </form>
                      @endcan
                    </td>

                  </tr>
                  @empty
                @endforelse
                <input type="hidden" name="user" id="user" value="">
              </tbody>
            </table>

            {{ $affectations->appends(request()->input())->links() }}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
    @include('statuts.change_js')
@endsection
