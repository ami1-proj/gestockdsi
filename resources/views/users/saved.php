@extends('layouts.app')

@section('page')
  @include('users._button_index')
@endsection

@section('buttons')
  @include('users._button_create')
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render('utilisateurs') }}
@endsection

@section('content')

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Liste</h4>
          <p class="text-muted m-b-30 font-14">Liste de tous les <code class="highlighter-rouge">Utilisateurs</code> du Système.</p>

          <div class="row">
            @include('layouts.message')
          </div>

          <!-- Panel de recherche -->
          <div class="row">
            <form action="{{ route('users.index') }}">
              @include('layouts.recherche_panel')
            </form>
          </div>
          <!-- Fin Panel de recherche -->

          <div class="row">
            <table class="table table-hover table-sm">
              <thead class="thead-default">
                  <tr>
                      <th class="font-weight-bold">#</th>
                      <th class="font-weight-bold">Nom</th>
                      <th class="font-weight-bold">E-Mail</th>
                      <th class="font-weight-bold">Roles</th>
                      <th class="font-weight-bold">Date Creation</th>
                      <th class="font-weight-bold text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                  <tr>
                    <td class="font-weight-bold text-left">{{ $user->id }}</td>
                    <td class="text-left">{{ $user->name  }}</td>
                    <td class="text-left">{{ $user->email  }}</td>
                    <td class="text-left">
                      @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                          <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                      @endif
                    </td>
                    <td class="text-left">{{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}</td>

                    <!-- ACTIONS -->

                    <td class="font-weight-bold text-center">
                        <a style="margin-right:20px" href="{{ action('UserController@show', ['user' => $user]) }}" alt="Détails" title="Details">
                          <i class="fa fa-eye" style="color:green"></i>
                        </a>
                      @can('user-edit')
                        <a style="margin-right:20px" href="{{ action('UserController@edit', ['user' => $user]) }}" alt="Modifer" title="Edit">
                          <i class="ti-pencil-alt"></i>
                        </a>
                      @endcan

                      @can('user-delete')
                          <a href="{{ action('UserController@destroy', ['user' => $user->id]) }}" onclick="if(confirm('Etes-vous sur de vouloir supprimer?')) event.preventDefault() ; document.getElementById('userdestroy-form').submit();">
                            <i class="ti-trash" style="color:red"></i>
                          </a>
                      @endcan
                      <form id="userdestroy-form" action="{{ action('UserController@destroy', ['user' => $user->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                      </form>
                    </td>

                  </tr>
                  @empty
                @endforelse
              </tbody>
            </table>

            {{ $users->appends(request()->input())->links() }}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
