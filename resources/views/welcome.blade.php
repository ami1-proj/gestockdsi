@extends('layouts.app')

@section('page')
  Bienvenue
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('home') }}
@endsection

@section('css')
<style type="text/css">
    body{
      /*background-color: #bdc3c7;*/
      }

    thead, tbody { display: block; }

    tbody {
      height: 340px;       /* Just for the demo          */
      overflow-y: auto;    /* Trigger vertical scroll    */
      overflow-x: hidden;  /* Hide the horizontal scroll */
    }
</style>
@endsection

@section('content')
<div class="row">
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-white">
              <span class="mini-stat-icon"><i class="ti-package"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles->count()}}</span> Total Articles
              </div>
          </div>
      </div>
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-success">
              <span class="mini-stat-icon"><i class="ti-harddrives"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$typearticles->count()}}</span> Total Types
              </div>
          </div>
      </div>
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-orange">
              <span class="mini-stat-icon"><i class="ti-server"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles_enstock->count()}}</span> Total Articles en Stock
              </div>
          </div>
      </div>
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-info">
              <span class="mini-stat-icon"><i class="ti-user"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles_enaffectation->count()}}</span> Total Articles en Affectation
              </div>
          </div>
      </div>
</div>

<div class="row">
  <div class="col-xl-12">
      <div class="card card-sec m-b-12">
          <div class="card-body">
              <h4 class="mt-12 m-b-12 header-title">Détails Types Article</h4>

              <!-- <div class="table-responsive"> -->
              <!-- <div style="position: relative; height: 200px; overflow: auto; display: block;">
                  <table class="table table-hover mb-0"> -->

                  <div class="table-responsive">
                    <table class="table table-hover mb-12">
                      <thead>
                          <!-- <tr class="titles">
                              <th>#</th>
                              <th>Libelle</th>
                              <th>Statut</th>
                              <th>Articles</th>
                              <th>Articles en Stock</th>
                              <th>Articles en Affectation</th>
                              <th>Articles en Bon Etat</th>
                              <th>Articles en Panne</th>
                          </tr> -->
                      </thead>
                      <tbody>
                        @forelse ($typearticles as $typearticle)
                              <tr>
                                <td class="c-table__cell">{{ $typearticle->id }}</td>
                                <td class="c-table__cell">
                                  <div class="user-wrapper">
                                    <div class="img-user">
                                      <img src="{{ url(config('app.typearticle_filefolder')).'/'. $typearticle->image }}" alt="{{ $typearticle->image }}" style="width:50px;" class="rounded-circle">
                                    </div>
                                    <div class="text-user">
                                      <p>{{ $typearticle->libelle }}</p>
                                    </div>
                                  </div>
                                </td>
                                <td class="c-table__cell">
                                  @if($typearticle->statut_id === 1)
                                    <span class="badge badge-success">{{ $typearticle->statut->libelle ?? '' }}</span>
                                  @else
                                    <span class="badge badge-danger">{{ $typearticle->statut->libelle ?? '' }}</span>
                                  @endif
                                </td>


                                <td class="c-table__cell">
                                  @if($typearticle->articles_count === 0)
                                    <span class="badge badge-danger">Total: {{ $typearticle->articles_count ?? '' }}</span>
                                  @else
                                    <span class="badge badge-primary">Total: {{ $typearticle->articles_count ?? '' }}</span>
                                  @endif
                                </td>


                                <td class="c-table__cell">
                                  @if($typearticle->articles_count > 0)
                                    @if($typearticle->articles_enstock_count === 0)
                                      <span class="badge badge-danger">En Stock: {{ $typearticle->articles_enstock_count ?? '' }}</span>
                                    @else
                                      <span class="badge badge-success">En Stock: {{ $typearticle->articles_enstock_count ?? '' }}</span>
                                    @endif
                                  @endif
                                </td>

                                <td class="c-table__cell">
                                  @if($typearticle->articles_count > 0)
                                    @if($typearticle->articles_enaffectation_count === 0)
                                      <span class="badge badge-danger">En Affectation: {{ $typearticle->articles_enaffectation_count ?? '' }}</span>
                                    @else
                                      <span class="badge badge-info">En Affectation: {{ $typearticle->articles_enaffectation_count ?? '' }}</span>
                                    @endif
                                  @endif
                                </td>

                                <td class="c-table__cell">
                                  @if($typearticle->articles_count > 0)
                                    @if($typearticle->articles_neuf_count === 0)
                                      <span class="badge badge-danger">Neufs: {{ $typearticle->articles_neuf_count ?? '' }}</span>
                                    @else
                                      <span class="badge badge-dark">Neufs: {{ $typearticle->articles_neuf_count ?? '' }}</span>
                                    @endif
                                  @endif
                                </td>

                                <td class="c-table__cell">
                                  @if($typearticle->articles_count > 0)
                                    @if($typearticle->articles_enpanne_count === 0)
                                      <span class="badge badge-warning">En Panne: {{ $typearticle->articles_enpanne_count ?? '' }}</span>
                                    @else
                                      <span class="badge badge-danger">En Panne: {{ $typearticle->articles_enpanne_count ?? '' }}</span>
                                    @endif
                                  @endif
                                </td>
                              </tr>
                          @empty
                          @endforelse
                      </tbody>
                    </table>
              </div>
          </div>
      </div>
    </div>

  </div>
@endsection
