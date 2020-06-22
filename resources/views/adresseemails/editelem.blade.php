@extends('layouts.app')

@section('page')
  Adresses e-mails
@endsection

@section('breadcrumb')
  {{ Breadcrumbs::render($elem_arr['breadcrumb'],$elem_arr['breadcrumb_param']) }}
@endsection

@section('content')

<div class="row">
  @include('layouts.message')
</div>

<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <h4 class="mt-0 header-title">Gestion</h4>

        <p class="text-muted m-b-30 font-14">{{ $elem_arr['text'] }} <code class="highlighter-rouge">{{ $elem_arr['display'] }}</code>.</p>

      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">

        <div class="row table-responsive-sm">
          <table class="table table-hover">
             <thead class="thead-dark">
              <th class="font-weight-bold">#</th>
              <th class="font-weight-bold">E-mail</th>
              <th class="Actions">Actions</th>
            </thead>
            <tbody>
                @forelse ($adresseemails as $adresseemail)
                    <tr>
                        <td>{{ $adresseemail->pivot->rang }}</td>
                        <td>{{ $adresseemail->email }}</td>
                        <td class="actions">

                          <form action="{{ action('AdresseemailController@updateelem', [$elem_arr['type'],$elem_arr['id'],$adresseemail->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button type="submit" name="action" value="up" class="btn bg-transparent"><i class="ion-arrow-up-b" style="color:green"></i></button>
                            <button type="submit" name="action" value="down" class="btn bg-transparent"><i class="ion-arrow-down-b" style="color:blue"></i></button>

                            <button type="submit" name="action" value="del" class="btn bg-transparent"><i class="ion-trash-a" style="color:red"></i></button>
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

  <div class="col-lg-6">
    <div class="card m-b-30">
      <div class="card-body">
        <div class="row">

          <form action="{{ route('adresseemails.storeelem', [$elem_arr['type'],$elem_arr['id']]) }}" method="POST">
            <div class="form-group {{ $errors->has('nouveau_email') ? 'has-error' : '' }}">
              <label>Nouveau E-mail</label>
              <div>
                <input type="text" name="nouveau_email" class="form-control" placeholder="E-mail à ajouter"/>
                <small class="text-danger">{{ $errors->has('nouveau_email') ? $errors->first('nouveau_email') : '' }}</small>
              </div>
            </div>

            @csrf
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Valider</button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">Reset</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="form-group m-b-0">
  <div>
    <a href="{{ action($elem_arr['edit_controller'], $elem_arr['id']) }}" class="btn btn-secondary waves-effect m-l-5">Retour</a>
  </div>
</div>

@endsection
