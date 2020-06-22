<div class="form-group row {{ $errors->has('nom') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="nom">Nom</label>
    <div class="col-sm-10">
        <input name="nom" type="text" class="form-control" placeholder="Nom de la Marque" value="{{ $marquearticle->nom ?? '' }}"/>
        <small class="text-danger">{{ $errors->has('nom') ? $errors->first('nom') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <input name="statut_id" {{ Auth::user()->can(\App\MarqueArticle::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $marquearticle->statut->code == 'actif' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>


@csrf
