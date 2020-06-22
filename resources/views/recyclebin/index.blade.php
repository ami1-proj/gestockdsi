@extends('layouts.app')

@section('page')
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('corbeille') }}
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Corbeille</h4>
          <p class="text-muted m-b-30 font-14">Liste des éléments <code class="highlighter-rouge">Supprimés</code> dans le Système.</p>

          <div class="row">
            @include('layouts.message')
          </div>

          <!-- Panel de recherche -->
          <div class="row">
            @include('layouts.recherche_panel', ['index_route'=>'RecycleBinController@index'])
          </div>
          <!-- Fin Panel de recherche -->

          <form id="recyclebin_form" class="" action="{{ action('RecycleBinController@restoreOrDelete') }}" method="post">
            @csrf

            <div class="row ml-1">
              <div class="ml-auto mr-3">
                <!-- <a name="action" value="restore" class="btn bg-transparent" href="#" onclick="if(confirm('Etes-vous sur de vouloir restaurer?')) {event.preventDefault(); document.getElementById('recyclebin_form').submit();}">
                  <i class="mdi mdi-backup-restore"></i>
                </a>
                <a name="action" value="delete" class="btn bg-transparent" href="#" onclick="if(confirm('Etes-vous sur de vouloir supprimer?')) {event.preventDefault(); document.getElementById('recyclebin_form').submit();}">
                  <i class="ti-trash" style="color:red"></i>
                </a> -->

                <button id="form_submit_restore" type="submit" name="action" value="restore" class="btn bg-transparent form_submit_rest" onclick= "return confirm('Etes-vous sur de vouloir restaurer le(s) élément(s) sélectionné(s)?')" disabled>
                  <i class="mdi mdi-backup-restore" style="color:blue"></i></button>
                <button id="form_submit_delete" type="submit" name="action" value="delete" class="btn bg-transparent form_submit_del" onclick="return confirm('Etes-vous sur de vouloir supprimer DEFINITIVEMENT le(s) élément(s) sélectionné(s)?')" disabled>
                  <i class="ti-trash" style="color:red"></i></button>
              </div>
            </div>

            <div class="row">

              <table class="table table-hover table-sm">
                <thead class="thead-default">
                    <tr>
                        <th class="font-weight-bold text-left"><input class="selectAllChbx" type="checkbox" name="selectall" value=""/></th>
                        <th class="font-weight-bold">#</th>
                        <th class="font-weight-bold">Type objet</th>
                        <th class="font-weight-bold">Id objet</th>
                        <th class="font-weight-bold">Dénomination</th>
                        <th class="font-weight-bold">Date suppression</th>

                        <th class="font-weight-bold text-center" colspan="1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @forelse ($trashes as $trashe)
                    <tr>
                      <td><input class="selectOneChbx" type="checkbox" name="selection[]" value="{{ $trashe->id }}" /></td>
                      <td class="font-weight-bold text-left">{{ $trashe->id }}</td>
                      <td class="text-left">{{ $trashe->object_model_name }}</td>
                      <td class="font-weight-italic text-left">{{ $trashe->object_id }}</td>
                      <td class="text-left">{{ $trashe->object_denomination }}</td>

                      <td class="text-left">{{ date('d-m-Y H:i:s', strtotime($trashe->created_at)) }}</td>

                      <!-- ACTIONS -->

                      <td style="width: 10px;">
                        <a href="{{ action('RecycleBinController@show', $trashe->id) }}" alt="Détails" title="Details">
                          <i class="fa fa-eye" style="color:green"></i>
                        </a>
                      </td>

                    </tr>
                    @empty
                  @endforelse
                  <input type="hidden" name="user" id="user" value="">
                </tbody>
              </table>

              {{ $trashes->appends(request()->input())->links() }}

            </div>


          </form>

        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')
    @include('recyclebin._js')
@endsection
