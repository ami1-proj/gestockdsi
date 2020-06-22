@extends('layouts.app')

@section('page')
  Etats Commandes
@endsection

@section('content')
 <div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Liste</h4>
          <p class="text-muted m-b-30 font-14">Liste des <code class="highlighter-rouge">Etat</code> Commande.</p>
  
<div class="row">
  @include('layouts.message')
</div>

<!-- Panel de recherche -->
<div class="row">
    <form action="{{ route('etatcommandes.index') }}">
    @include('layouts.recherche_panel')
  </form>
</div>
<!-- Fin Panel de recherche -->  


<div class="row">
  <table class="table table-hover table-sm">
  <thead class="thead-default">
  <table class="table">
    <thead>
        <tr>
            <th class="font-weight-bold">ID</th>
            <th class="font-weight-bold">Libelle</th>
            
            <th class="font-weight-bold">Statut</th>
            <th class="font-weight-bold">Date Creation</th>
            <th colspan="3" style="text-align: center" style="text-align: center" class="Actions">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($etatcommandes as $etatcommande)
            <tr>
                <td>{{ $etatcommande->id }}</td>
                <td>{{ $etatcommande->libelle }}</td>
                
                <td>{{ $etatcommande->statut->libelle }}</td>
                <td>{{ date('F d, Y', strtotime($etatcommande->created_at)) }}</td>
               <td class="actions">
                 <button type="button" class="btn btn-link">
                    <a href="{{ action('EtatCommandeController@show', ['etatcommande' => $etatcommande]) }}"
                        alt="View" title="Details">
                        <i class="fa fa-eye" style="color: green"></i>
                    </a>
                    </button>
                </td> 

              <td>
                @can('etat_commande-edit')
                 <button type="button" class="btn btn-link">
                    <a href="{{ action('EtatCommandeController@edit', ['etatcommande' => $etatcommande]) }}"
                        alt="Edit" title="Modifier">
                        <i class="fa fa-edit" style="color: blue"></i>
                    </a>
                    </button>
                    @endcan

              </td>  
                
               <td> 
                    <form action="{{ action('EtatCommandeController@destroy', ['etatcommande' => $etatcommande]) }}" method="POST">
                      @method('DELETE')
                      @csrf
                      @can('etat_commande-delete')
                      <button type="submit" class="btn btn-link" title="Delete" value="DELETE" onclick='return confirm("Are you sure you want to delete this?")'><i class="fa fa-trash" style="color: red"></i></button>
                      @endcan
                    </form>
                </td>  
            </tr>
        @empty
        @endforelse
    </tbody>
  </table>

  {{ $etatcommandes->appends(request()->input())->links() }}
</div>

@endsection
