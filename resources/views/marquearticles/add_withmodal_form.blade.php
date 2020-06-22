<!-- Attachment Modal -->

<div class="modal fade" id="create-marquearticle-modal" tabindex="-1" role="dialog" aria-labelledby="create-marquearticle-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-marquearticle-modal-label">Creer Nouvelle Marque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        <form id="add_marquearticles_form" class="form-horizontal" action="{{ route('marquearticles.softadd') }}" method="POST">
          <div class="card text-white bg-dark mb-0">
            <div class="card-body">
              <!-- nom -->
              <div class="form-group">
                <label class="col-form-label" for="nom">Nom</label>
                <input type="text" name="nom" class="form-control" id="modal-input-nom" required autofocus>
                <span id="error-nom" class="invalid-feedback"></span>
              </div>
              <!-- /nom -->

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
