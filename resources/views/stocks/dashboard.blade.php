<div class="row">
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-white">
              <span class="mini-stat-icon"><i class="ti-package"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles_enstock->count()}}</span> Total Articles En Stock
              </div>
          </div>
      </div>
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-success">
              <span class="mini-stat-icon"><i class="ti-harddrives"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles_nouveaux->count()}}</span> Articles Nouveaux
              </div>
          </div>
      </div>
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-orange">
              <span class="mini-stat-icon"><i class="ti-server"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles_enpanne->count()}}</span> Articles en Panne
              </div>
          </div>
      </div>
      <div class="col-md-6 col-xl-3">
          <div class="mini-stat clearfix bg-info">
              <span class="mini-stat-icon"><i class="ti-user"></i></span>
              <div class="mini-stat-info text-right text-light">
                  <span class="counter text-white">{{$articles_enpanne->count()}}</span> Total Articles Ancien
              </div>
          </div>
      </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card m-b-30 card-body">
            <h3 class="card-title font-20 mt-0">Affecter article(s) a un Departement</h3>
            <p class="card-text">Ici vous avez la possibilé d'affecter un ou plusieurs articles a un département.<br />A partir de liste de départements, rechercher le département a affecter et clicker sur <i class="fa fa-paperclip" style="color:green"></i> pour effectuer l'affectation</p>
            <a href="{{ route('departements.index') }}" class="btn btn-primary waves-effect waves-light">Cliquez ici</a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card m-b-30 card-body">
            <h3 class="card-title font-20 mt-0">Affecter article(s) a un Employe</h3>
            <p class="card-text">Ici vous avez la possibilé d'affecter un ou plusieurs articles a un employe.<br />A partir de liste de départements, rechercher le département a affecter et clicker sur <i class="fa fa-paperclip" style="color:green"></i> pour effectuer l'affectations</p>
            <a href="{{ route('employes.index') }}" class="btn btn-primary waves-effect waves-light">Cliquez ici</a>
          </div>
    </div>
</div>

<div class="row">
  <div class="col-xl-6">
      <div class="card card-sec m-b-12">
          <div class="card-body">
              <h4 class="mt-12 m-b-12 header-title">Résumé par Types Article</h4>

                  <div class="table-responsive">
                    <table class="table table-hover mb-12">
                      <thead>
                      </thead>
                      <tbody>
                        @forelse ($typearticles as $typearticle)
                            @if($typearticle->articles_enstock_count > 0)
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
                              @endif

                          @empty
                          @endforelse
                      </tbody>
                    </table>
              </div>
          </div>
      </div>
  </div>

  <div class="col-xl-6">
      <div class="card card-sec m-b-12">
          <div class="card-body">
              <h4 class="mt-12 m-b-12 header-title">Rupture Stock (par Types Article)</h4>

                  <div class="table-responsive">
                    <table class="table table-hover mb-12">
                      <thead>
                      </thead>
                      <tbody>
                        @forelse ($typearticles as $typearticle)
                              @if($typearticle->articles_enstock_count === 0)
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
                              @endif

                          @empty
                          @endforelse
                      </tbody>
                    </table>
              </div>
          </div>
      </div>
  </div>
</div>
