<div class="container text-center situation_pro tab step" id="8-content">
  <div data-category="Situation financière du foyer"></div>
  <div class="title">
    <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4  text-center">
      MES REVENUS MENSUELS
    </h2>
  </div>
  <div class="step1_1A_project col-12">
    <div class="row justify-content-center">
      <!-- Mon salaire net mensuel avant impôt -->
      <label for="revenus" class="col-12 col-md-4 fw-bold text-start">Mon salaire net mensuel avant impôt :</label>
      <div class="select2-selection--single col-12 col-md-8">
        <div class="input-group">
          <input type="number" inputmode="numeric" pattern="[0-9]*" id="revenus" name="revenus" class="form-control input-number form-input col-12" placeholder='Ex : 2 300' data-type="integer">
          <span class="input-group-text">€/mois</span>
        </div>
        <div class="col-12 error-container d-none text-start mt-3" id="error-revenus">
          <p>Veuillez remplir ce champ</p>
        </div>
      </div>
    </div>
  </div>
  <div class="btnForm btn-form-mesrevenus mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>
