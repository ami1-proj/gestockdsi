@extends('layouts.app')

@section('page')

@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('parametres') }}
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

<div class="card m-b-30">
    <div class="card-body">

        <h4 class="mt-0 header-title">Paramètres de l Application</h4>
        <p class="text-muted m-b-30 font-14">Les informations de cette rubrique sont tres <code class="highlighter-rouge">sensibles</code>
            car contribuent au fonction de l application. Les modifications ici ne doivent etre portees que par un administrateur.</p>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ ($active_tab === 'statut' ) ? 'active' : '' }}" data-toggle="tab" href="#statut" role="tab">Statut</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active_tab === 'etatarticle' ) ? 'active' : '' }}" data-toggle="tab" href="#etat_articles" role="tab">Etat Articles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active_tab === 'typeaffectation' ) ? 'active' : '' }}" data-toggle="tab" href="#type_affectations" role="tab">Type Affectations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active_tab === 'typemouvement' ) ? 'active' : '' }}" data-toggle="tab" href="#type_mouvements" role="tab">Type Mouvements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active_tab === 'etatcommande' ) ? 'active' : '' }}" data-toggle="tab" href="#etat_commandes" role="tab">Etat Commandes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($active_tab === 'typedepartement' ) ? 'active' : '' }}" data-toggle="tab" href="#type_departements" role="tab">Type Departement</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">

            <!-- STATUT -->

            <div class="tab-pane {{ ($active_tab === 'statut' ) ? 'active' : '' }} p-3" id="statut" role="tabpanel">
              <p class="text-muted m-b-30 font-14">Liste des Statuts référence dans l'Application.</p>

              <p>
                <a href="{{ route('statuts.create') }}" class="btn btn-primary waves-effect m-l-5"><i class="fa fa-plus"></i></a>
              </p>

              <div class="row">
                  <table class="table table-hover table-sm">
                    <thead class="thead-default">
                        <tr>
                            <th class="font-weight-bold">#</th>
                            <th class="font-weight-bold">Libelle</th>
                            <th class="font-weight-bold">Par Défaut ?</th>
                            <th class="font-weight-bold">Tags</th>
                            <th class="font-weight-bold">Date Creation</th>
                            <th style="text-align:center" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($statuts as $statut)
                            <tr>
                                <td>{{ $statut->id }}</td>
                                <td>{{ $statut->libelle }}</td>
                                <td>
                                  <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $statut->is_default ? 'checked="checked"' : '' }}/>
                                </td>
                                <td>{{ $statut->tags }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($statut->created_at)) }}</td>

                                <!-- ACTIONS -->

                                <td style="width:1px; white-space:nowrap">
                                  <button type="button" class="btn btn-link">
                                    <a href="{{ action('StatutController@show', ['statut' => $statut]) }}" alt="Détails" title="Details">
                                      <i class="fa fa-eye" style="color:green"></i>
                                    </a>
                                  </button>
                                </td>

                                <td style="width:1px; white-space:nowrap">
                                  <button type="button" class="btn btn-link">
                                    <a href="{{ action('StatutController@edit', ['statut' => $statut]) }}" alt="Modifer" title="Edit">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                  </button>
                                </td>

                                <td style="width:1px; white-space:nowrap">
                                  <form action="{{ action('StatutController@destroy', ['statut' => $statut->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color:red"></i></button>
                                  </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                  </table>
                </div>

            </div>

            <!-- ETAT ARTICLE -->

            <div class="tab-pane {{ ($active_tab === 'etatarticle' ) ? 'active' : '' }} p-3" id="etat_articles" role="tabpanel">
              <p class="text-muted m-b-30 font-14">Liste des Statuts référence dans l'Application.</p>

              <p>
                <a href="{{ route('etatarticles.create') }}" class="btn btn-primary waves-effect m-l-5"><i class="fa fa-plus"></i></a>
              </p>

              <div class="row">
                <table class="table table-hover table-sm">
                  <thead class="thead-default">
                      <tr>
                          <th class="font-weight-bold">#</th>
                          <th class="font-weight-bold">Libelle</th>
                          <th class="font-weight-bold">Par Défaut ?</th>
                          <th class="font-weight-bold">Tags</th>
                          <th class="font-weight-bold">Statut</th>
                          <th class="font-weight-bold">Date Creation</th>
                          <th style="text-align:center" colspan="3">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($etatarticles as $etatarticle)
                          <tr>
                              <td>{{ $etatarticle->id }}</td>
                              <td>{{ $etatarticle->libelle }}</td>
                              <td>
                                <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $etatarticle->is_default ? 'checked="checked"' : '' }}/>
                              </td>
                              <td>{{ $etatarticle->tags }}</td>
                              <td>
                                <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $etatarticle->statut->code == 'actif' ? 'checked' : '' }}>
                              </td>
                              <td>{{ date('d-m-Y H:i:s', strtotime($etatarticle->created_at)) }}</td>

                              <!-- ACTIONS -->

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('EtatArticleController@show', ['etatarticle' => $etatarticle]) }}" alt="Détails" title="Details">
                                    <i class="fa fa-eye" style="color:green"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('EtatArticleController@edit', ['etatarticle' => $etatarticle]) }}" alt="Modifer" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <form action="{{ action('EtatArticleController@destroy', ['etatarticle' => $etatarticle->id]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color:red"></i></button>
                                </form>
                              </td>
                          </tr>
                      @empty
                      @endforelse
                  </tbody>
                </table>
              </div>

            </div>

            <!-- TYPE AFFECTATION -->

            <div class="tab-pane {{ ($active_tab === 'typeaffectation' ) ? 'active' : '' }} p-3" id="type_affectations" role="tabpanel">
              <p class="text-muted m-b-30 font-14">Liste Types d'Affectation de l'Application. <br /> <code class="highlighter-red">Attention! Un Type d'Affectation ne doit avoir q'un seul Tag. </code></p>

              <p>
                <a href="{{ route('typeaffectations.create') }}" class="btn btn-primary waves-effect m-l-5"><i class="fa fa-plus"></i></a>
              </p>

              <div class="row">
                <table class="table table-hover table-sm">
                  <thead class="thead-default">
                      <tr>
                          <th class="font-weight-bold">#</th>
                          <th class="font-weight-bold">Libelle</th>
                          <th class="font-weight-bold">Par Défaut ?</th>
                          <th class="font-weight-bold">Tags</th>
                          <th class="font-weight-bold">Classe</th>
                          <th class="font-weight-bold">Statut</th>
                          <th class="font-weight-bold">Date Creation</th>
                          <th style="text-align:center" colspan="3">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($typeaffectations as $typeaffectation)
                          <tr>
                              <td>{{ $typeaffectation->id }}</td>
                              <td>{{ $typeaffectation->libelle }}</td>
                              <td>
                                <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $typeaffectation->is_default ? 'checked="checked"' : '' }}/>
                              </td>
                              <td>{{ $typeaffectation->tags }}</td>
                              <td>{{ $typeaffectation->object_class_name }}</td>
                              <td>
                                <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $typeaffectation->statut->code == 'actif' ? 'checked' : '' }}>
                              </td>
                              <td>{{ date('d-m-Y H:i:s', strtotime($typeaffectation->created_at)) }}</td>

                              <!-- ACTIONS -->

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('TypeAffectationController@show', ['typeaffectation' => $typeaffectation]) }}" alt="Détails" title="Details">
                                    <i class="fa fa-eye" style="color:green"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('TypeAffectationController@edit', ['typeaffectation' => $typeaffectation]) }}" alt="Modifer" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <form action="{{ action('TypeAffectationController@destroy', ['typeaffectation' => $typeaffectation->id]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color:red"></i></button>
                                </form>
                              </td>
                          </tr>
                      @empty
                      @endforelse
                  </tbody>
                </table>
              </div>

            </div>

            <!-- TYPE MOUVEMENT -->

            <div class="tab-pane {{ ($active_tab === 'typemouvement' ) ? 'active' : '' }} p-3" id="type_mouvements" role="tabpanel">
              <p class="text-muted m-b-30 font-14">Liste des Type de Mouvements des Articles.</p>

              <p>
                <a href="{{ route('typemouvements.create') }}" class="btn btn-primary waves-effect m-l-5"><i class="fa fa-plus"></i></a>
              </p>

              <div class="row">
                <table class="table table-hover table-sm">
                  <thead class="thead-default">
                      <tr>
                          <th class="font-weight-bold">#</th>
                          <th class="font-weight-bold">Libelle</th>
                          <th class="font-weight-bold">Par Défaut ?</th>
                          <th class="font-weight-bold">Tags</th>
                          <th class="font-weight-bold">Statut</th>
                          <th class="font-weight-bold">Date Creation</th>
                          <th style="text-align:center" colspan="3">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($typemouvements as $typemouvement)
                          <tr>
                              <td>{{ $typemouvement->id }}</td>
                              <td>{{ $typemouvement->libelle }}</td>
                              <td>
                                <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $typemouvement->is_default ? 'checked="checked"' : '' }}/>
                              </td>
                              <td>{{ $typemouvement->tags }}</td>
                              <td>
                                <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $typemouvement->statut->code == 'actif' ? 'checked' : '' }}>
                              </td>
                              <td>{{ date('d-m-Y H:i:s', strtotime($typemouvement->created_at)) }}</td>

                              <!-- ACTIONS -->

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('TypeMouvementController@show', ['typemouvement' => $typemouvement]) }}" alt="Détails" title="Details">
                                    <i class="fa fa-eye" style="color:green"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('TypeMouvementController@edit', ['typemouvement' => $typemouvement]) }}" alt="Modifer" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <form action="{{ action('TypeMouvementController@destroy', ['typemouvement' => $typemouvement->id]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color:red"></i></button>
                                </form>
                              </td>
                          </tr>
                      @empty
                      @endforelse
                  </tbody>
                </table>
              </div>

            </div>

            <!-- ETAT COMMANDE -->
            <div class="tab-pane {{ ($active_tab === 'etatcommande' ) ? 'active' : '' }} p-3" id="etat_commandes" role="tabpanel">
              <p class="text-muted m-b-30 font-14">Liste des Etats que peuvent avoir une commande.</p>

              <p>
                <a href="{{ route('etatcommandes.create') }}" class="btn btn-primary waves-effect m-l-5"><i class="fa fa-plus"></i></a>
              </p>

              <div class="row">
                <table class="table table-hover table-sm">
                  <thead class="thead-default">
                      <tr>
                          <th class="font-weight-bold">#</th>
                          <th class="font-weight-bold">Libelle</th>
                          <th class="font-weight-bold">Par Défaut ?</th>
                          <th class="font-weight-bold">Tags</th>
                          <th class="font-weight-bold">Statut</th>
                          <th class="font-weight-bold">Date Creation</th>
                          <th style="text-align:center" colspan="3">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($etatcommandes as $etatcommande)
                          <tr>
                              <td>{{ $etatcommande->id }}</td>
                              <td>{{ $etatcommande->libelle }}</td>
                              <td>
                                <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $etatcommande->is_default ? 'checked="checked"' : '' }}/>
                              </td>
                              <td>{{ $etatcommande->tags }}</td>
                              <td>
                                <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $etatcommande->statut->code == 'actif' ? 'checked' : '' }}>
                              </td>
                              <td>{{ date('d-m-Y H:i:s', strtotime($etatcommande->created_at)) }}</td>

                              <!-- ACTIONS -->

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('EtatCommandeController@show', ['etatcommande' => $etatcommande]) }}" alt="Détails" title="Details">
                                    <i class="fa fa-eye" style="color:green"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('EtatCommandeController@edit', ['etatcommande' => $etatcommande]) }}" alt="Modifer" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <form action="{{ action('EtatCommandeController@destroy', ['etatcommande' => $etatcommande->id]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color:red"></i></button>
                                </form>
                              </td>
                          </tr>
                      @empty
                      @endforelse
                  </tbody>
                </table>
              </div>

            </div>


            <!-- ETAT COMMANDE -->
            <div class="tab-pane {{ ($active_tab === 'typedepartement' ) ? 'active' : '' }} p-3" id="type_departements" role="tabpanel">
              <p class="text-muted m-b-30 font-14">Liste des Types de Departement.</p>

              <p>
                <a href="{{ route('typedepartements.create') }}" class="btn btn-primary waves-effect m-l-5"><i class="fa fa-plus"></i></a>
              </p>

              <div class="row">
                <table class="table table-hover table-sm">
                  <thead class="thead-default">
                      <tr>
                          <th class="font-weight-bold">#</th>
                          <th class="font-weight-bold">Intitule</th>
                          <th class="font-weight-bold">Par Défaut ?</th>
                          <th class="font-weight-bold">Tags</th>
                          <th class="font-weight-bold">Statut</th>
                          <th class="font-weight-bold">Date Creation</th>
                          <th style="text-align:center" colspan="3">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($typedepartements as $typedepartement)
                          <tr>
                              <td>{{ $typedepartement->id }}</td>
                              <td>{{ $typedepartement->intitule }}</td>
                              <td>
                                <input disabled readonly type="checkbox" name="is_default" class="switch-input" value="1" {{ $typedepartement->is_default ? 'checked="checked"' : '' }}/>
                              </td>
                              <td>{{ $typedepartement->tags }}</td>
                              <td>
                                <input disabled class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $typedepartement->statut->code == 'actif' ? 'checked' : '' }}>
                              </td>
                              <td>{{ date('d-m-Y H:i:s', strtotime($typedepartement->created_at)) }}</td>

                              <!-- ACTIONS -->

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('TypeDepartementController@show', ['typedepartement' => $typedepartement]) }}" alt="Détails" title="Details">
                                    <i class="fa fa-eye" style="color:green"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <button type="button" class="btn btn-link">
                                  <a href="{{ action('TypeDepartementController@edit', ['typedepartement' => $typedepartement]) }}" alt="Modifer" title="Edit">
                                    <i class="fa fa-edit"></i>
                                  </a>
                                </button>
                              </td>

                              <td style="width:1px; white-space:nowrap">
                                <form action="{{ action('TypeDepartementController@destroy', ['typedepartement' => $typedepartement->id]) }}" method="POST">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color:red"></i></button>
                                </form>
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
