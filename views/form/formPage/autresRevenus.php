<div class="container text-center situation_pro tab step" id="10-content">
  <div data-category="Situation financière du foyer"></div>
  <div class="row" id="creditConso">
    <div class="title">
      <h2 class="text-primary offset-md-2 offset-md-4 text-center text-md-start">
        AUTRES REVENUS MENSUELS DU FOYER
      </h2>
    </div>
    <div class="step1_1A_project col-12">
      <div class="row">
        <!-- REVENUS LOCATIFS MENSUELS DU FOYER -->
        <div class="section-container">
          <!-- Revenus locatifs mensuels du foyer : -->
          <div class="row">
            <label for="revenusLocatifs" class="col-12 col-md-4 fw-bold text-start labelSalaire">Revenus locatifs mensuels du foyer :</label>
            <div class="col-12 col-md-8">
              <div class="input-group">
                <input type="number" inputmode="numeric" pattern="[0-9]*" id="revenusLocatifs" name="revenusLocatifs" class="form-control input-number form-input col-11 mask" placeholder='Ex : 800' data-type="integer">
                <span class="input-group-text">€/mois</span>
              </div>
              <div class="col-12 error-container d-none text-start mt-3" id="error-revenusLocatifs">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
        </div>

        <!-- AUTRES REVENUS MENSUELS DU FOYER -->
        <div class="section-container custom-margin">
          <!-- Autres revenus mensuels du foyer : -->
          <div class="row">
            <label for="autresRevenusFoyer" class="col-12 col-md-4 fw-bold text-start labelAutresRevenus labelWithAfterLabel">Autres revenus mensuels du foyer :
              <p class="afterLabel paragrapheAutresRevenus">(Pension alimentaire, autres pensions…)</p>
            </label>
            <div class="col-12 col-md-8">
              <div class="input-group">
                <input type="number" inputmode="numeric" pattern="[0-9]*" id="autresRevenusFoyer" name="autresRevenusFoyer" class="form-control input-number form-input col-11 mask" placeholder='Ex : 100' data-type="integer">
                <span class="input-group-text">€/mois</span>
              </div>
              <div class="col-12 error-container d-none text-start mt-3" id="error-autresRevenusFoyer">
              <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ALLOCATIONS MENSUELLES DU FOYER -->
        <div class="section-container custom-margin">
          <!-- Allocations mensuelles du foyer : -->
          <div class="row">
            <label for="allocationsFoyer" class="col-12 col-md-4 fw-bold text-start labelAllocations labelWithAfterLabel">Allocations mensuelles du foyer :
              <p class="afterLabel paragrapheAllocations">(Allocations familiales et APL)</p>
            </label>
            <div class="col-12 col-md-8">
              <div class="input-group">
                <input type="number" inputmode="numeric" pattern="[0-9]*" id="allocationsFoyer" name="allocationsFoyer" class="form-control input-number form-input col-11 mask" placeholder='Ex : 100' data-type="integer">
                <span class="input-group-text">€/mois</span>
              </div>
              <div class="col-12 error-container d-none text-start mt-3" id="error-allocationsFoyer">
                <p>Veuillez remplir ce champ</p>
              </div>
            </div>
          </div>
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