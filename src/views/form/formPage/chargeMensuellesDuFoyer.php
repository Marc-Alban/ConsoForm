<div class="container text-center situation_pro tab step" id="12-content">
  <div data-category="Situation financière du foyer"></div>
  <div class="title">
    <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4  text-center">
      CHARGES MENSUELLES DU FOYER
    </h2>
  </div>
  <div class="step1_1A_project col-12">
    <div class="row justify-content-center">
      <!-- Montant total des mensualités de mes crédits conso en cours : -->
      <label for="mensualitesConso" class="col-12 col-md-6 fw-bold text-start">Montant total des mensualités de mes crédits conso en cours :</label>
      <div class="select2-selection--single col-12 col-md-6">
        <div class="input-group">
          <input type="text" inputmode="numeric" pattern="[0-9]*" id="mensualitesConso" name="mensualitesConso" class="form-control input-number form-input col-12" placeholder='Ex : 500' data-type="integer">
          <span class="input-group-text">€/mois</span>
        </div>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-mensualitesConso">
          <p>Veuillez remplir ce champ</p>
        </div>
      </div>

      <!-- Montant total restant à rembourser de mes crédits conso en cours : -->
      <label for="restantConso" class="col-12 col-md-6 fw-bold text-start mt-4">Montant total restant à rembourser de mes crédits conso en cours :</label>
      <div class="select2-selection--single col-12 col-md-6 mt-4">
        <div class="input-group">
          <input type="text" inputmode="numeric" pattern="[0-9]*" id="restantConso" name="restantConso" class="form-control  input-number form-input col-12" placeholder='Ex : 5000' data-type="integer">
          <span class="input-group-text">€</span>
        </div>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-restantConso">
          <p>Veuillez remplir ce champ</p>
        </div>
      </div>

      <!-- Montant total des mensualités de mes prêts immo en cours : -->
      <label for="mensualitesImmo" class="col-12 col-md-6 fw-bold text-start mt-4">Montant total des mensualités de mes prêts immo en cours :</label>
      <div class="select2-selection--single col-12 col-md-6 mt-4">
        <div class="input-group">
          <input type="text" inputmode="numeric" pattern="[0-9]*" id="mensualitesImmo" name="mensualitesImmo" class="form-control input-number form-input col-12" placeholder='Ex : 1000' data-type="integer">
          <span class="input-group-text">€/mois</span>
        </div>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-mensualitesImmo">
          <p>Veuillez remplir ce champ</p>
        </div>
      </div>

      <!-- Montant total restant à rembourser de mes prêts immo en cours : -->
      <label for="restantImmo" class="col-12 col-md-6 fw-bold text-start mt-4">Montant total restant à rembourser de mes prêts immo en cours :</label>
      <div class="select2-selection--single col-12 col-md-6 mt-4">
        <div class="input-group">
          <input type="text" inputmode="numeric" pattern="[0-9]*" id="restantImmo" name="restantImmo" class="form-control input-number form-input col-12" placeholder='Ex : 100000' data-type="integer">
          <span class="input-group-text">€</span>
        </div>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-restantImmo">
          <p>Veuillez remplir ce champ</p>
        </div>
      </div>
      
    </div>
  </div>
  <div class="btnForm btn-form-changemens mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>
