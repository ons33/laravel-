

<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Add Offre de Stage</div>

              <div class="card-body">
                  <form method="POST" action="{{ route('offre.store') }}">
                      @csrf

                      <div class="form-group">
                          <label for="titre">Titre</label>
                          <input type="text" name="titre" id="titre" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="Societe">Societe</label>
                          <input type="text" name="Societe" id="Societe" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="emplacement">Emplacement</label>
                          <input type="text" name="emplacement" id="emplacement" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="Type">Type</label>
                          <input type="text" name="Type" id="Type" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="apropos">Apropos</label>
                          <textarea name="apropos" id="apropos" class="form-control" required></textarea>
                      </div>

                      <div class="form-group">
                          <label for="salaire">Salaire</label>
                          <input type="text" name="salaire" id="salaire" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Add Offre</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

