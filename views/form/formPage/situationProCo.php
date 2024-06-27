<div class="container text-center situation_pro tab subStepCoBorrower step" id="7-content" style="display: none;">
  <div data-category="Situation professionnelle du co-emprunteur"></div>
  <div class="row" id="situationProfessionalCo">
    <div class="title">
      <h2 class="text-primary offset-md-2 offset-md-4 text-center text-md-start">
        SITUATION PROFESSIONNELLE DU CO-EMPRUNTEUR
      </h2>
    </div>
    <div class="step1_1A_project conso_label col-12">
      <div class="row">
        <div class="container-div">
          <!-- Champ de sélection du secteur d'activité -->
          <div class="form-group">
            <div class="row">
              <label for="secteurActiviteCo" class="col-12 col-md-4 fw-bold text-start">Secteur d'activité :</label>
              <div class="select2-selection--single col-12 col-md-8">
                <select id="secteurActiviteCo" name="secteurActiviteCo" class="form-select situationProfession form-input col-12" data-type="select">
                  <option value="">Sélectionner</option>
                  <option value="public">Secteur public</option>
                  <option value="prive">Secteur privé</option>
                  <option value="agricole">Secteur agricole</option>
                  <option value="artisans">Secteur artisans - commerçants</option>
                  <option value="liberales">Professions libérales</option>
                  <option value="retraites">Retraités ou autres</option>
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-secteurActiviteCo">
                  <p>Veuillez choisir parmi les champs proposés</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Champ de sélection du statut -->
          <div class="form-group">
            <div class="row">
              <label for="statutCo" class="col-12 col-md-4 fw-bold text-start">Son statut :</label>
              <div class="select2-selection--single col-12 col-md-8">
                <select id="statutCo" name="statutCo" class="form-select situationStatut form-input col-12" data-type="select">
                  <option value="">Sélectionner</option>
                  <!-- Options seront ajoutées dynamiquement ici -->
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-statutCo">
                  <p>Veuillez choisir parmi les champs proposés</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Champ de sélection de la profession -->
          <div class="form-group">
            <div class="row">
              <label for="professionCo" class="col-12 col-md-4 fw-bold text-start">Sa profession :</label>
              <div class="select2-selection--single col-12 col-md-8">
                <select id="professionCo" name="professionCo" class="form-select situationProfession form-input col-12" data-type="select">
                  <option value="">Sélectionner</option>
                  <!-- Options seront ajoutées dynamiquement ici -->
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-professionCo">
                  <p>Veuillez choisir parmi les champs proposés</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Champ de sélection du type de contrat -->
          <div class="form-group">
            <div class="row">
              <label for="typeContratCo" class="col-12 col-md-4 fw-bold text-start">Son contrat :</label>
              <div class="select2-selection--single col-12 col-md-8">
                <select id="typeContratCo" name="typeContratCo" class="form-select situationContrat form-input col-12" data-type="select">
                  <option value="">Sélectionner</option>
                  <!-- Options seront ajoutées dynamiquement ici -->
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-typeContratCo">
                  <p>Veuillez choisir parmi les champs proposés</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Champ de sélection de la date de début -->
          <div class="form-group">
            <div class="row">
              <label for="dateDebutCo" class="col-12 col-md-4 fw-bold text-start">Depuis (JJ/MM/AAAA) :</label>
              <div class="select2-selection--single col-12 col-md-8">
                <input type="text" id="dateDebutCo" name="dateDebutCo" placeholder="JJ/MM/AAAA" class="form-input col-12" data-type="dateFr">
                <div class="col-12 error-container d-none text-start mt-3" id="error-dateDebutCo">
                  <p>Veuillez remplir ce champ</p>
                </div>
              </div>
            </div>
          </div>

          <!--------------------- FIN MA SITUATION PROFESSIONNELLE --------------------------->
        </div>
      </div>
    </div>
  </div>

  <div class="btnForm mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev">
        <i class="fa-solid fa-arrow-left"></i>Retour
      </button>
      <button type="button" class="btn btn-primary btnNext">
        Suivant<i class="fas fa-arrow-right"></i>
      </button>
    </div>
  </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", () => {
  // Initialisation du validateur de formulaire
  const formValidatorInstance = new FormValidator(".form-container .step", ".btnNext", ".btnPrev", "#summary");

  const selects = document.querySelectorAll('select');
  selects.forEach(select => {
    select.addEventListener('change', function () {
      const selectOption = this.querySelector('option[value=""]');
      if (selectOption) {
        selectOption.disabled = true;
      }
    });
  });

  // Mise à jour des options en fonction des sélections
  document.getElementById('secteurActivite').addEventListener('change', () => {
    formValidatorInstance.updateOptions();
    formValidatorInstance.validateField(document.getElementById('secteurActivite'));
  });

  document.getElementById('statut').addEventListener('change', () => {
    formValidatorInstance.updateContractOptions();
    formValidatorInstance.validateField(document.getElementById('statut'));
  });

  // Mise à jour des options pour le co-emprunteur
  document.getElementById('secteurActiviteCo').addEventListener('change', () => {
    formValidatorInstance.updateOptionsCo();
    formValidatorInstance.validateField(document.getElementById('secteurActiviteCo'));
  });

  document.getElementById('statutCo').addEventListener('change', () => {
    formValidatorInstance.validateField(document.getElementById('statutCo'));
  });

  // Afficher l'étape actuelle au chargement
  formValidatorInstance.showCurrentStep();
});
</script>