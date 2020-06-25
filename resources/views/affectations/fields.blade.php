<div class="col-lg-12">
  <div class="card m-b-30">
    <div class="card-body">

      <div class="form-group row {{ $errors->has('objet') ? 'has-error' : '' }}">
          <label class="col-sm-2 col-form-label" for="objet">Objet</label>
          <div class="col-sm-10">
              <input name="objet" type="text" class="form-control" placeholder="Objet" value="{{ old('objet', $affectation->objet ?? '') }}"/>
              <small class="text-danger">{{ $errors->has('objet') ? $errors->first('objet') : '' }}</small>
          </div>
      </div>

      <div class="form-group row {{ $errors->has('date_debut') ? 'has-error' : '' }}">
          <label class="col-sm-2 col-form-label" for="objet">Date Affectation</label>
          <div class="col-sm-10">

              <div class="input-group">
                  <input name="date_debut" type="text" class="form-control" placeholder="dd/mm/yyyy" id="datepicker-autoclose" value="{{ old('date_debut', $affectation->date_debut ?? $nowdate) }}" >
                  <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
              </div>
              <small class="text-danger">{{ $errors->has('date_debut') ? $errors->first('date_debut') : '' }}</small>

          </div>
      </div>


      @if(isset($affectation->id))
        <div class="form-group row {{ $errors->has('details') ? 'has-error' : '' }}">
            <label class="col-sm-2 col-form-label" for="details">Details</label>
            <div class="col-sm-10">
                <input name="details" type="text" class="form-control" placeholder="Details Modification" value="{{ old('details', $affectation->details ?? '') }}"/>
                <small class="text-danger">{{ $errors->has('details') ? $errors->first('details') : '' }}</small>
            </div>
        </div>
      @endif

    </div>
  </div>
</div>

<div class="col-lg-6">
  <div class="card m-b-30">
    <div class="card-body">
      <h6 class="card-title">Articles à Affecter</h6>
      <p class="card-text"><small class="text-muted m-b-30 font-10">Sélectionnez au moins un article. Gardez la touche <code class="highlighter-rouge">Ctrl</code> enfoncé pour sélectionner plusieurs ou déselectionner.</small></p>

      <p>
        <div class="col-md-4">
          <button name="action" value="remove-articles" class="btn btn-outline-secondary"><i class="ion-ios7-redo"></i></button>
        </div>
      </p>

      <div class="form-group row {{ $errors->has('articles_a_affecter') ? 'has-error' : '' }}">
        @if(isset($articles_a_affecter))
          <select class="select2 form-control" name="articles_a_affecter_selected[]" multiple="multiple" id="articles_a_affecter">
            @foreach($articles_a_affecter as $id => $display)
              <option value="{{ $id }}">{{ $display }}</option>
            @endforeach
          </select>
        @endif
        <small class="text-danger">{{ $errors->has('articles_a_affecter') ? $errors->first('articles_a_affecter') : '' }}</small>
      </div>
      <input type="hidden" name="articles_a_affecter" value="{{ $articles_a_affecter_json }}">
    </div>
  </div>
</div>


<div class="col-lg-6">
  <div class="card m-b-30">
    <div class="card-body">
      <h6 class="card-title">Articles Disponibles</h6>
      <p class="card-text"><small class="text-muted m-b-30 font-10">Sélectionnez au moins un article. Gardez la touche <code class="highlighter-rouge">Ctrl</code> enfoncé pour sélectionner plusieurs ou déselectionner.</small></p>


      <p>
        <div class="col-md-4">
          <div class="input-group form-inline mb-3">

            <span class="input-group-prepend">
              <button name="action" value="add-articles" class="btn btn-outline-secondary"><i class="ion-ios7-undo"></i></button>
            </span>

            <input class="form-control form-control-sm" type="search" name="q" value="{{ $q }}">

            <span class="input-group-append">
              <button name="action" value="search-articles" class="btn btn-outline-secondary"><i class="ti-search"></i></button>
            </span>
          </div>
      </div>
      </p>

      <div class="form-group row {{ $errors->has('articles_disponibles') ? 'has-error' : '' }}">
        @if(isset($articles_disponibles))
        <select class="select2 form-control" name="articles_disponibles_selected[]" multiple="multiple" id="articles_disponibles">
          @foreach($articles_disponibles as $id => $display)
            <option value="{{ $id }}">{{ $display }}</option>
          @endforeach
        </select>
        @endif
        <small class="text-danger">{{ $errors->has('articles_disponibles') ? $errors->first('articles_disponibles') : '' }}</small>
      </div>

      <input type="hidden" name="articles_disponibles" value="{{ $articles_disponibles_json }}">

    </div>
  </div>
</div>
