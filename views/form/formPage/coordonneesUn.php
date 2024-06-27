<div class="container text-center situation_pro tab step" id="15-content">
  <div data-category="Coordonnées"></div>
  <div class="row" id="creditRac">
    <!-- auto -->
    <div class="title">
      <h2 class="text-primary offset-md-3 col-md-6 text-center">
        MON ÉTAT CIVIL
      </h2>
    </div>
    <div class="step1_1A_project col-12">
      <div class="row">
        <!-- Mes coordonnées -->
        <div class="container-div-text">
          <!-- Civilité -->
          <div class="row mb-3">
            <label for="civilite" class="col-12 col-md-3 fw-bold text-start">Civilité :</label>
            <div class="col-12 col-md-8">
              <div class="row">
                <div class="col-6 d-grid gap-2">
                  <input type="radio" id="civilite_mr" name="civilite" value="MR" class="invisible" data-type="radio">
                  <label for="civilite_mr" class="btn btn-form">Monsieur</label>
                </div>
                <div class="col-6 d-grid gap-2">
                  <input type="radio" id="civilite_mme" name="civilite" value="MME" class="invisible" data-type="radio">
                  <label for="civilite_mme" class="btn btn-form">Madame</label>
                </div>
              </div>
              <div class="col-12 error-container d-none text-start mt-3" id="error-civilite">
                <p>Veuillez choisir un de ces champs</p>
              </div>
            </div>
          </div>
          <!-- Nom et Nom de naissance -->
          <div class="row mb-3">
            <label for="nom" class="col-12 col-md-3 fw-bold text-start">Nom :</label>
            <div class="col-12 col-md-3">
              <input type="text" id="nom" name="nom" class="form-input col-12" placeholder='Ex : DUPONT' data-type="string">
              <div class="col-12 error-container d-none text-start mt-3" id="error-nom">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
            <label for="nomNaissance" class="col-12 col-md-3 fw-bold text-start" style="">Nom de naissance : <br> <small class="smallLabel">Facultatif</small></label>
            <div class="col-12 col-md-3">
              <input type="text" id="nomNaissance" name="nomNaissance" class="form-input col-12" placeholder='Ex : DUPONT' data-type="string">
              <div class="col-12 error-container d-none text-start mt-3" id="error-nomNaissance">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
          <!-- Prénom -->
          <div class="row mb-3">
            <label for="prenom" class="col-12 col-md-3 fw-bold text-start">Prénom :</label>
            <div class="col-12 col-md-8">
              <input type="text" id="prenom" name="prenom" class="form-input col-12" placeholder='Ex : Olivier' data-type="string">
              <div class="col-12 error-container d-none text-start mt-3" id="error-prenom">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
          <!-- Date de naissance -->
          <div class="row mb-3">
            <label for="dateNaissance" class="col-12 col-md-3 fw-bold text-start">Date de naissance: <br> <small class="smallLabel">(JJ/MM/AAAA)</small></label>
            <div class="col-12 col-md-8">
              <div class="input-group-date">
                <input type="text" id="dateNaissance" name="dateNaissance" class="form-date-etat col-12 col-md-12 col-lg-11 date-input" placeholder="JJ/MM/AAAA" data-type="dateFr">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              </div>
              <div class="col-12 error-container d-none text-start mt-3" id="error-dateNaissance">
                <p>Veuillez saisir une date valide</p>
              </div>
            </div>
          </div>
          <!-- Ville de naissance et Pays de naissance -->
          <div class="row mb-3">
            <label for="villeNaissance" class="col-12 col-md-3 fw-bold text-start">Ville de naissance :</label>
            <div class="col-12 col-md-3">
              <input type="text" id="villeNaissance" name="villeNaissance" class="form-input col-12" placeholder='Ex : Paris' data-type="string">
              <div class="col-12 error-container d-none text-start mt-3" id="error-villeNaissance">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
            <label for="paysNaissance" class="col-12 col-md-3 fw-bold text-start" style="">Pays de naissance :</label>
            <div class="col-12 col-md-3">
              <select id="paysNaissance" name="paysNaissance" class="form-select form-input" data-type="select"> 
                <option value="" disabled selected>Sélectionner</option>
                <option value="France">France</option>
                <option value="Autre">Autre</option>
              </select>
              <div class="col-12 error-container d-none text-start mt-3" id="error-paysNaissance">
                <p>Veuillez choisir un pays</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- fin auto -->
  <div class="btnForm mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>

