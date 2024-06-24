<div class="container text-center situation_pro tab subStepCoBorrower step" id="7-content">
  <div data-category="Situation financière du co-emprunteur"></div>
  <div class="row" id="situationProfessional">
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
                <select id="secteurActiviteCo" name="secteurActiviteCo" class="form-select situationProfession form-input col-12" onchange="updateOptionsCo()" data-type="select">
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
const optionsCo = {
  public: {
    statut: [
      { value: "agent_service", text: "Agent de service" },
      { value: "agent_public", text: "Agent public" },
      { value: "aide_soignant", text: "Aide soignant hospitalier" },
      { value: "cadre_moyen", text: "Cadre moyen instituteur" },
      { value: "cadre_superieur", text: "Cadre supérieur et professeur" },
      { value: "employe_administratif", text: "Employé et agent administratif" },
      { value: "infirmiere_paramedical", text: "Infirmière et profession paramédicale" },
      { value: "ouvrier_etat", text: "Ouvrier d'Etat" }
    ],
    profession: [
      { value: "infirmiere", text: "Infirmière" },
      { value: "agent_securite", text: "Agent de sécurité" },
      { value: "assistante_maternelle", text: "Assistante maternelle - Employé de maison" },
      { value: "cadre_moyen", text: "Cadre moyen" },
      { value: "cadre_superieur", text: "Cadre supérieur" },
      { value: "chauffeur_livreur", text: "Chauffeur et livreur" },
      { value: "contremaitre", text: "Contremaître - agent de maîtrise" },
      { value: "dirigeant", text: "Dirigeant de société" },
      { value: "employe_bureau", text: "Employé de bureau" },
      { value: "employe_commerce", text: "Employé de commerce" },
      { value: "employe_garage", text: "Employé de garage - apporteur" },
      { value: "ingenieur", text: "Ingénieur" },
      { value: "ouvrier", text: "Ouvrier" },
      { value: "representant_salarie", text: "Représentant salarié" },
      { value: "technicien", text: "Technicien" },
      { value: "vendeur", text: "Vendeur - caissier de magasin" }
    ],
    typeContrat: [
      { value: "cdi", text: "CDI" },
      { value: "cdi_essai", text: "CDI période d'essai non terminée" },
      { value: "cdd", text: "CDD" },
      { value: "stage", text: "Stage" },
      { value: "interim", text: "Intérim" },
      { value: "autres", text: "Autres" }
    ]
  },
  prive: {
    statut: [
      { value: "employe_bureau", text: "Employé de bureau" },
      { value: "employe_commerce", text: "Employé de commerce" },
      { value: "dirigeant", text: "Dirigeant de société" },
      { value: "ingenieur", text: "Ingénieur" },
      { value: "ouvrier", text: "Ouvrier" },
      { value: "technicien", text: "Technicien" },
      { value: "vendeur", text: "Vendeur - caissier de magasin" }
    ],
    profession: [
      { value: "employe_bureau", text: "Employé de bureau" },
      { value: "employe_commerce", text: "Employé de commerce" },
      { value: "dirigeant", text: "Dirigeant de société" },
      { value: "ingenieur", text: "Ingénieur" },
      { value: "ouvrier", text: "Ouvrier" },
      { value: "technicien", text: "Technicien" },
      { value: "vendeur", text: "Vendeur - caissier de magasin" }
    ],
    typeContrat: [
      { value: "cdi", text: "CDI" },
      { value: "cdi_essai", text: "CDI période d'essai non terminée" },
      { value: "cdd", text: "CDD" },
      { value: "stage", text: "Stage" },
      { value: "interim", text: "Intérim" },
      { value: "autres", text: "Autres" }
    ]
  }
};

function updateOptionsCo() {
  const secteurActiviteCo = document.getElementById('secteurActiviteCo').value;
  const statutCoSelect = document.getElementById('statutCo');
  const professionCoSelect = document.getElementById('professionCo');
  const typeContratCoSelect = document.getElementById('typeContratCo');

  statutCoSelect.innerHTML = '<option value="">Sélectionner</option>';
  professionCoSelect.innerHTML = '<option value="">Sélectionner</option>';
  typeContratCoSelect.innerHTML = '<option value="">Sélectionner</option>';

  if (optionsCo[secteurActiviteCo]) {
    optionsCo[secteurActiviteCo].statut.forEach(option => {
      statutCoSelect.innerHTML += `<option value="${option.value}">${option.text}</option>`;
    });
    optionsCo[secteurActiviteCo].profession.forEach(option => {
      professionCoSelect.innerHTML += `<option value="${option.value}">${option.text}</option>`;
    });
    optionsCo[secteurActiviteCo].typeContrat.forEach(option => {
      typeContratCoSelect.innerHTML += `<option value="${option.value}">${option.text}</option>`;
    });
  }
}
</script>