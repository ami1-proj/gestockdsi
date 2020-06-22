<!-- Attachment Modal -->

<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modal-label">Creer Nouvelle Fonction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="add_fonctionemployes_form" class="form-horizontal" action="{{ route('fonctionemployes.softadd') }}" method="POST">
          <div class="card text-white bg-dark mb-0">
            <div class="card-body">
              <!-- intitule -->
              <div class="form-group">
                <label class="col-form-label" for="intitule">Intitulé</label>
                <input type="text" name="intitule" class="form-control" id="modal-input-intitule" required autofocus>
                <span id="error-intitule" class="invalid-feedback"></span>
              </div>
              <!-- /intitule -->
              <!-- description -->
              <div class="form-group">
                <label class="col-form-label" for="description">Description</label>
                <input type="text" name="description" class="form-control" id="modal-input-description">
                <span id="error-description" class="invalid-feedback"></span>
              </div>
              <!-- /description -->

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Valider</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              </div>

            </div>
          </div>

          @csrf
        </form>
      </div>

    </div>
  </div>
</div>
<!-- /Attachment Modal -->
