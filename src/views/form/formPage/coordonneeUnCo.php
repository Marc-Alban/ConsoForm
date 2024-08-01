<div class="container text-center situation_pro tab step subStepCoBorrower" id="15-content">
  <div data-category="Coordonnées co-emprunteur"></div>
  <div class="row" id="creditRac">
    <div class="title">
      <h2 class="text-primary offset-md-3 col-md-6 text-center">
        ÉTAT CIVIL DU CO-EMPRUNTEUR
      </h2>
    </div>
    <div class="step1_1A_project col-12">
      <div class="row">
        <!-- Mes coordonnées -->
        <div class="section-container" id="etatCivilCo">
          <!-- Civilité -->
          <div class="row">
            <label for="civilite" class="col-12 col-md-4 fw-bold text-start">Civilité :</label>
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
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-civilite">
                <p>Veuillez choisir un de ces champs</p>
              </div>
            </div>
          </div>
          <!-- Nom -->
          <div class="row custom-margin">
            <label for="nom" class="col-12 col-md-4 fw-bold text-start">Nom :</label>
            <div class="col-12 col-md-8">
              <input type="text" id="nom" name="nom" class="form-control form-input col-11" placeholder='Ex : Durant' data-type="string">
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-nom">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
          <!-- Nom de naissance -->
          <div class="row custom-margin">
            <label for="nomNaissance" class="col-12 col-md-4 fw-bold text-start">Nom de naissance :</label>
            <div class="col-12 col-md-8">
              <input type="text" id="nomNaissance" name="nomNaissance" class="form-control form-input col-11" placeholder='Facultatif' data-type="string">
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-nomNaissance">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
          <!-- Prénom -->
          <div class="row custom-margin">
            <label for="prenom" class="col-12 col-md-4 fw-bold text-start">Prénom :</label>
            <div class="col-12 col-md-8">
              <input type="text" id="prenom" name="prenom" class="form-control form-input col-11" placeholder='Ex : Sophie' data-type="string">
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-prenom">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
          <!-- Date de naissance -->
          <div class="row custom-margin">
            <label for="dateNaissance" class="col-12 col-md-4 fw-bold text-start">Date de naissance (JJ/MM/AAAA) :</label>
            <div class="col-12 col-md-8">
              <div class="input-group">
                <input type="text" id="dateNaissance" name="dateNaissance" class="form-control form-input col-11 input-group2 date-input" placeholder="JJ/MM/AAAA" data-type="dateFr">
                <span class="calendar-icon"><i class="fa-solid fa-calendar"></i></span>
              </div>
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-dateNaissance">
                <p>Veuillez saisir une date valide</p>
              </div>
            </div>
          </div>
          <!-- Ville de naissance -->
          <div class="row custom-margin">
            <label for="villeNaissance" class="col-12 col-md-4 fw-bold text-start">Ville de naissance :</label>
            <div class="col-12 col-md-8">
              <input type="text" id="villeNaissance" name="villeNaissance" class="form-control form-input col-11" placeholder='Ex : Paris' data-type="string">
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-villeNaissance">
                <p>Veuillez remplir ce champ</p>
              </div>
              <!-- Liste des résultats pour l'auto-complétion -->
              <ul id="resultsListNaissanceCo"></ul>
            </div>
          </div>
          <!-- Pays de naissance -->
          <div class="row custom-margin">
            <label for="paysNaissance" class="col-12 col-md-4 fw-bold text-start">Pays de naissance :</label>
            <div class="col-12 col-md-8">
              <select id="paysNaissance" name="paysNaissance" class="form-select form-input col-11" data-type="select">
                <option value="" disabled selected>France</option>
                <!-- Les options seront ajoutées ici par JavaScript -->
              </select>
              <div class="col-12 error-container text-start mt-3" style="display:none" id="error-paysNaissance">
                <p>Veuillez choisir un pays</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="btnForm mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>
