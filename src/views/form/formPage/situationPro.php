<div class="container text-center situation_pro tab step" id="6-content">
  <div data-category="Situation professionnelle"></div>
  <div class="row" id="situationProfessional">
    <div class="title">
      <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4 text-center">
        MA SITUATION PROFESSIONNELLE
      </h2>
    </div>
    <div class="step1_1A_project col-12">
      <div class="row justify-content-center">
        <!-- Champ pour le secteur d'activité -->
        <div class="col-12 row mb-3">
          <label for="secteurActivite" class="col-md-4 fw-bold text-start">Mon secteur d'activité :</label>
          <div class="select2-selection--single col-md-8">
            <select id="secteurActivite" name="secteurActivite" class="form-select form-input col-12" data-type="select" required>
              <option value="">Sélectionner</option>
              <option value="public">Secteur public</option>
              <option value="prive">Secteur privé</option>
              <option value="agricole">Secteur agricole</option>
              <option value="artisans">Secteur artisans - commerçants</option>
              <option value="liberales">Professions libérales</option>
              <option value="retraites">Retraités ou autres</option>
            </select>
            <div class="col-12 error-container d-none text-start mt-3" id="error-secteurActivite">
              <p>Veuillez choisir parmi les champs proposés</p>
            </div>
          </div>
        </div>

        <!-- Conteneur pour le statut, initialement caché -->
        <div id="statutContainer" class="col-12 row mb-3 d-none">
          <label for="statut" class="col-md-4 fw-bold text-start mt-4">Mon statut :</label>
          <div class="select2-selection--single col-md-8 mt-4">
            <select id="statut" name="statut" class="form-select form-input col-12" data-type="select" required>
              <option value="">Sélectionner</option>
            </select>
            <div class="col-12 error-container d-none text-start mt-3" id="error-statut">
              <p>Veuillez choisir parmi les champs proposés</p>
            </div>
          </div>
        </div>

        <!-- Conteneur pour la profession, initialement caché -->
        <div id="professionContainer" class="col-12 row mb-3 d-none">
          <label for="profession" class="col-md-4 fw-bold text-start mt-4">Ma profession :</label>
          <div class="select2-selection--single col-md-8 mt-4">
            <input type="text" id="profession" name="profession" class="form-control form-input col-12" placeholder="Champs à remplir" required>
            <div class="col-12 error-container d-none text-start mt-3" id="error-profession">
              <p>Veuillez remplir ce champ</p>
            </div>
          </div>
        </div>

        <!-- Conteneur pour le type de contrat, initialement caché -->
        <div id="typeContratContainer" class="col-12 row mb-3 d-none">
          <label for="typeContrat" class="col-md-4 fw-bold text-start mt-4">Mon contrat :</label>
          <div class="select2-selection--single col-md-8 mt-4">
            <select id="typeContrat" name="typeContrat" class="form-select form-input col-12" data-type="select">
              <option value="">Sélectionner</option>
            </select>
            <div class="col-12 error-container d-none text-start mt-3" id="error-typeContrat">
              <p>Veuillez choisir parmi les champs proposés</p>
            </div>
          </div>
        </div>

        <!-- Conteneur pour la date de début, initialement caché -->
        <div id="dateDebutContainer" class="col-12 row mb-3 d-none">
          <label for="dateDebut" class="col-md-4 fw-bold text-start mt-4">Depuis (JJ/MM/AAAA) :</label>
          <div class="select2-selection--single col-md-8 mt-4">
            <div class="input-group">
              <input type="text" id="dateDebut" name="dateDebut" placeholder="JJ/MM/AAAA" class="form-control date-input form-input col-12" data-type="dateFr" required>
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
            </div>
            <div class="col-12 error-container d-none text-start mt-3" id="error-dateDebut">
              <p>Veuillez remplir ce champ</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Boutons de navigation -->
  <div class="btnForm mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev">
        <i class="fa-solid fa-arrow-left"></i>Retour
      </button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>