@extends('layouts.app')

@section('page')
  @include('layouts._button_index', ['canlist' => App\Affectation::canlist(), 'index_route' => \App\Affectation::$route_index, 'model' => $affectation, 'title' => 'Affectations'])
@endsection

@section('buttons')
  @include('layouts._button_edit', ['canedit' => \App\Affectation::canedit(), 'edit_route' => \App\Affectation::$route_edit, 'model' => $affectation])
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb_show'],$elem_arr['elem']->id,$affectation->id) }}
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

        <p class="text-muted m-b-30 font-14">Détails de l affection <code class="highlighter-rouge"><strong>{{ $affectation->objet }}</strong></code>  assignee {{ $elem_arr['article'] }}  {{ $elem_arr['type'] }} <strong>{{ $elem_arr['elem']->denomination }}</strong>.</p>

        <div class="row">
            <div class="col-lg-6">
              <div class="card m-b-30">
                <div class="card-body">

                  <dl class="row">
                      <dt class="col-sm-3">ID</dt>
                      <dd class="col-sm-9">{{ $affectation->id }}</dd>

                      <dt class="col-sm-3">Objet</dt>
                      <dd class="col-sm-9">{{ $affectation->objet }}</dd>

                      <dt class="col-sm-3">Type</dt>
                      <dd class="col-sm-9">{{ $affectation->typeAffectation->libelle }}</dd>

                      <dt class="col-sm-3">{{ $elem_arr['type'] }}</dt>
                      <dd class="col-sm-9">{{ $affectation->beneficiaire->denomination }}</dd>

                      <dt class="col-sm-3">Statut</dt>
                      <dd class="col-sm-9">{{ $affectation->statut->libelle }}</dd>

                      <dt class="col-sm-3">Créé le</dt>
                      <dd class="col-sm-9">{{ date('d-m-Y H:i:s', strtotime($affectation->created_at)) }}</dd>

                      <dt class="col-sm-3">Modifié le</dt>
                      <dd class="col-sm-9">{{ date('d-m-Y H:i:s', strtotime($affectation->updated_at)) }}</dd>
                  </dl>

                </div>
              </div>
            </div>  

            <div class="col-lg-6">
              <div class="card m-b-30">
                <div class="card-body">
                  <div class="row">

                    <div class="input-group form-inline mb-3">
                      <label class="col-form-label form-control-sm" for="permissions">Article(s)</label>
                      <span class="input-group-append">
                        <input type="checkbox" name="display_all" class="switch-input showAllChbx" value="1"/>
                      </span>
                    </div>

                    <table class="table table-hover table-sm" id="articlesTbl">
                      <thead class="thead-default">
                        <tr>
                          <th class="font-weight-bold">#</th>
                          <th class="font-weight-bold">Référence Complète</th>
                          <th class="font-weight-bold">Date ajout</th>
                          <th class="font-weight-bold">Motif ajout</th>
                          <th class="font-weight-bold">Date retrait</th>
                          <th class="font-weight-bold">Motif retrait</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($affectation->affectationarticles as $affectationarticle)
                          @if($affectationarticle->date_fin)
                          <tr style="background-color: orange ;">
                          @else
                          <tr>
                          @endif
                            <td>{{ $affectationarticle->article->id }}</td>
                            <td>{{ $affectationarticle->article->reference_complete }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($affectationarticle->date_debut)) }}</td>
                            <td>{{ $affectationarticle->details_debut }}</td>
                            <td>{{ $affectationarticle->date_fin ? date('d-m-Y H:i:s', strtotime($affectationarticle->date_fin)) : '' }}</td>
                            <td>{{ $affectationarticle->details_fin }}</td>
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
          <div class="row">
            @can(\App\Affectation::canprint())
            <div class="col-sm-3">
              <a href="{{ action('AffectationController@pdf', $affectation) }}" class="btn btn-primary">
                <i class="fa fa-print"></i>
                Imprimer
              </a>
            </div>
            @endcan
          </div>

        </div>
      </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">

$('.showAllChbx').on('change', function() {
  	if(this.checked){
    	showNotEndedArticles();
  	}else{
  		showAllArticles();
  	}
});

function showNotEndedArticles() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  // filter = input.value.toUpperCase();
  table = document.getElementById("articlesTbl");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue == "") {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function showAllArticles() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  // filter = input.value.toUpperCase();
  table = document.getElementById("articlesTbl");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    tr[i].style.display = "";
  }
}
</script>
@endsection
