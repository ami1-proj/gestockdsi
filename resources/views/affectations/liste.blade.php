<div class="row">
  <h4 class="mt-0 header-title">Affectation(s)</h4>

  <table class="table table-hover table-sm">
    <thead class="thead-default">
        <tr>
            <th class="font-weight-bold">Objet</th>
            <th class="font-weight-bold">Article(s)</th>
            <th style="text-align:center" colspan="3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($affectations as $affectation)
            <tr>
                <td class="block" style="width:50%">{{ $affectation->objet }}</td>
                <td class="block" style="width:50%">
                  <select class="select2 form-control" name="articles_disponibles[]" multiple="multiple" id="articles_disponibles">
                      @forelse ($affectation->affectationarticles as $affectationarticle)
                          @if($affectationarticle->date_fin)
                        @else
                          <option><small class="font-weight-light">{{ $affectationarticle->article->reference_complete }}</small></option>
                        @endif
                      @empty
                      @endforelse
                  </select>
                </td>

                <!-- ACTIONS -->

                <td>
                  <button type="button" class="btn btn-link">
                    <a href="{{ action('AffectationController@show', ['affectation' => $affectation]) }}" alt="Détails" title="View">
                      <i class="fa fa-eye" style="color:green"></i>
                    </a>
                  </button>
                </td>

                <td>
                  <button type="button" class="btn btn-link">
                    <a href="{{ action('AffectationController@edit', ['affectation' => $affectation]) }}" alt="Modifer" title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                  </button>
                </td>

                <td>
                    <form action="{{ action('AffectationController@destroy', ['affectation' => $affectation]) }}" method="POST">
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

@if($elem->isDeleted($elem))
@else
<div class="row">
    <a href="{{ action('AffectationController@elemcreate', [$type_affectation_tag, $elem->id]) }}" class="btn btn-primary waves-effect m-l-5">Nouvelle Affectation</a>
</div>
@endif
