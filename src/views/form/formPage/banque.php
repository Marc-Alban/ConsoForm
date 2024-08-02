<div class="container text-center situation_pro tab step" id="14-content">
  <div data-category="Situation financière du foyer"></div>
  <div class="title">
    <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4  text-center">
      MA BANQUE PRINCIPALE
    </h2>
  </div>
  <div class="step1_1A_project col-12">
    <div class="row ">
      <!-- Ma banque principale -->
      <label for="maBanque" class="col-12 col-md-4 fw-bold text-start">Ma banque principale :</label>
      <div class="select2-selection--single col-12 col-md-8">
        <select id="maBanque" name="maBanque" class="form-select form-input col-12" data-type="select" required>
          <option value="" disabled selected>Sélectionner</option>
          <option value="Banque populaire">Banque populaire</option>
          <option value="BNP Paribas">BNP Paribas</option>
          <option value="Boursorama">Boursorama</option>
          <option value="Caisse d'épargne">Caisse d'épargne</option>
          <option value="Crédit Agricole">Crédit Agricole</option>
          <option value="Crédit du Nord">Crédit du Nord</option>
          <option value="Crédit Mutuel / CIC">Crédit Mutuel / CIC</option>
          <option value="Fortuneo">Fortuneo</option>
          <option value="HSBC">HSBC</option>
          <option value="La Banque Postale">La Banque Postale</option>
          <option value="LCL">LCL</option>
          <option value="Société Générale">Société Générale</option>
          <option value="Autres">Autres</option>
        </select>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-maBanque">
          <p>Veuillez choisir parmi les champs proposés</p>
        </div>
      </div>

      <!-- Année d'ouverture -->
      <label for="anneeOuverture" class="col-12 col-md-4 fw-bold text-start mt-4">Année d'ouverture :</label>
      <div class="select2-selection--single col-12 col-md-6 mt-4">
        <input type="text" id="anneeOuverture" name="anneeOuverture" class="input-number form-control form-input col-12" placeholder="Ex : 2020" required >
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-anneeOuverture">
          <p>Veuillez remplir ce champ</p>
        </div>
      </div>

      <!-- Mon niveau de connaissance dans le crédit -->
      <label for="niveauConnaissance" class="col-12 col-md-4 fw-bold text-start mt-4">Mon niveau de connaissance dans le crédit :</label>
      <div class="select2-selection--single col-12 col-md-8 mt-4">
        <select id="niveauConnaissance" name="niveauConnaissance" class="form-select form-input col-12" data-type="select" required>
          <option value="" disabled selected>Sélectionner</option>
          <option value="Débutant">Débutant</option>
          <option value="Intermédiaire">Intermédiaire</option>
          <option value="Confirmé">Confirmé</option>
          <option value="Expert">Expert</option>
        </select>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-niveauConnaissance">
          <p>Veuillez choisir parmi les champs proposés</p>
        </div>
      </div>
    </div>
  </div>
  <div class="btnForm btn-form-banque mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>
