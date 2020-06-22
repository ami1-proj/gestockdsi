@extends('layouts.app')

@section('page')
  Type Mouvement
@endsection

@section('content')
  <div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Liste</h4>
          <p class="text-muted m-b-30 font-14">Liste de tous les <code class="highlighter-rouge">Type d'Affectation</code> du Système.</p>

<div class="row">
  @include('layouts.message')
</div>

<!-- Panel de recherche -->
<div class="row">
    <form action="{{ route('typeaffectations.index') }}">
    @include('layouts.recherche_panel')
  </form>
</div>
<!-- Fin Panel de recherche -->  


<div class="row">
  <table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            
            <th>Statut</th>
            <th>Date Creation</th>
            <th class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($typeaffectations as $typeaffectation)
            <tr>
                <td>{{ $typeaffectation->id }}</td>
                <td>{{ $typeaffectation->libelle }}</td>
                
                <td>{{ $typeaffectation->statut->libelle }}</td>
                <td>{{ date('F d, Y', strtotime($typeaffectation->created_at)) }}</td>
                <td class="actions">
                    <a class="btn btn-primary"
                        href="{{ action('TypeAffectationController@show', ['typeaffectation' => $typeaffectation->id]) }}"
                        alt="View"
                        title="View">
                      Details
                    </a>
                    @can('type_affectation-edit')
                    <a class="btn btn-info" 
                        href="{{ action('TypeAffectationController@edit', ['typeaffectation' => $typeaffectation->id]) }}"
                        alt="Edit"
                        title="Edit">
                      Modifier
                    </a>
                    @endcan
                    <form action="{{ action('TypeAffectationController@destroy', ['typeaffectation' => $typeaffectation->id]) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      @can('type_affectation-delete')
                      <button type="submit" class="btn btn-danger" title="Delete" value="DELETE">supprimer</button> @endcan
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </tbody>
  </table>

  {{ $typeaffectations->appends(request()->input())->links() }}
   </div>
  </div>
  </div>
 </div>
</div>

@endsection
