<div class="form-group row {{ $errors->has('reference') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="reference">Référence</label>
    <div class="col-sm-10">
        <input name="reference" type="text" class="form-control" placeholder="Référence" value="{{ old('reference', $article->reference ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('reference') ? $errors->first('reference') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('taille') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="taille">Taille</label>
    <div class="col-sm-10">
        <input name="taille" type="text" class="form-control" placeholder="Taille" value="{{  old('taille', $article->taille ?? '') }}"/>
        <small class="text-danger">{{ $errors->has('taille') ? $errors->first('taille') : '' }}</small>
    </div>
</div>


<div class="form-group row {{ $errors->has('affectation_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="affectation_id">Situation</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" value="{{  $article->affectation_id ? $article->situation()->typeAffectation->libelle  : 'Stock' }}" readonly style="background-color:transparent; border:0"/>
    </div>

    <!-- <div class="col-sm-10">
        <select name="affectation_id" class="form-control" id="affectation_id" required>

            @foreach($type_affectations as $id => $display)
                <option value="{{ $id }}" {{ (isset($article->affectation_id) && $id === $article->affectation_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('affectation_id') ? $errors->first('affectation_id') : '' }}</small>
    </div> -->
</div>

<div class="form-group row {{ $errors->has('date_livraison') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label" for="date_livraison">Date de Livraison</label>
    <div class="col-sm-10">
        <!-- <input name="date_livraison" type="text" class="form-control" placeholder="Date Livraison" value="{{ date('d-m-Y H:i:s' , strtotime(old('date_livraison', $article->date_livraison ?? '')) ) }}" readonly style="background-color:transparent"/> -->


        <div class="input-group">
            <input name="date_livraison" type="text" class="form-control" placeholder="dd-mm-yyyy" id="datepicker-autoclose" value="{{ old('date_livraison', $article->date_livraison ?? $nowdate) }}" >
            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
        </div>
        <small class="text-danger">{{ $errors->has('date_livraison') ? $errors->first('date_livraison') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('type_article_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="type_article_id">Type</label>
    <div class="col-sm-10">
        <select name="type_article_id" class="type_article_id form-control" id="type_article_id" required>
            @if(isset($article->id))
              @foreach($type_articles as $id => $display)
                  <option value="{{ $id }}" {{ (isset($article->type_article_id) && $id === $article->type_article_id) ? 'selected' : '' }}>{{ $display }}</option>
              @endforeach
            @endif
        </select>
        <small class="text-danger">{{ $errors->has('type_article_id') ? $errors->first('type_article_id') : '' }}</small>
    </div>
</div>

<div class="form-group row {{ $errors->has('fournisseur_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="fournisseur_id">Fournisseur</label>
    <div class="col-sm-10">
        <select name="fournisseur_id" class="fournisseur_id form-control" id="fournisseur_id" required>
          @if(isset($article->id))
            @foreach($fournisseurs as $id => $display)
                <option value="{{ $id }}" {{ (isset($article->fournisseur_id) && $id === $article->fournisseur_id && (!($article->fournisseur->isDeleted($article)))) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
          @endif
        </select>
        <small class="text-danger">{{ $errors->has('fournisseur_id') ? $errors->first('fournisseur_id') : '' }}</small>
    </div>
</div>


<div class="form-group row {{ $errors->has('marque_article_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="marque_article_id">Marque</label>

    <div class="col-sm-8">
        <select name="marque_article_id" class="marque_article_id form-control" id="marque_article_id" required>
            @if(isset($article->id))
              @foreach($marque_articles as $id => $display)
                  <option value="{{ $id }}" {{ (isset($article->marque_article_id) && $id === $article->marque_article_id) ? 'selected' : '' }}>{{ $display }}</option>
              @endforeach
            @endif
        </select>
        <small class="text-danger">{{ $errors->has('marque_article_id') ? $errors->first('marque_article_id') : '' }}</small>
    </div>

    <div class="col-sm-2">
      <button type="button" class="btn bg-transparent" id="create-marquearticle" data-item-id="1"><i class="ion-plus-round" style="color:green"></i></button>
    </div>
</div>



<div class="form-group row {{ $errors->has('etat_article_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="etat_article_id">Etat</label>
    <div class="col-sm-10">
        <select name="etat_article_id" class="form-control" id="etat_article_id" required>
            @foreach($etat_articles as $id => $display)
                <option value="{{ $id }}" {{ (isset($article->etat_article_id) && $id === $article->etat_article_id) ? 'selected' : '' }}>{{ $display }}</option>
            @endforeach
        </select>
        <small class="text-danger">{{ $errors->has('etat_article_id') ? $errors->first('etat_article_id') : '' }}</small>
    </div>
</div>


<div class="form-group row {{ $errors->has('statut_id') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"for="statut_id">Statut</label>
    <div class="col-sm-10">
        <input name="statut_id" {{ Auth::user()->can(\App\Article::canchange_statut()) ? '' : 'disabled' }} class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Actif" data-off="Inactif" data-size="xs" {{ $article->statut->code == 'actif' ? 'checked' : '' }}>
        <small class="text-danger">{{ $errors->has('statut_id') ? $errors->first('statut_id') : '' }}</small>
    </div>
</div>

<input name="affectation_id" type="hidden" class="form-control hidden" placeholder="Situation" value="{{  $article->affectation_id ?? 1 }}"/>

@csrf
