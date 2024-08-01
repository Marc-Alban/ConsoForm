<div class="container text-center situation_pro tab step" id="5-content">
  <div data-category="Situation familiale"></div>
  <div class="title">
    <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4 text-center">
      MA SITUATION FAMILIALE
    </h2>
  </div>
  <div class="step1_1A_project col-12">
    <div class="row justify-content-center">
      <!-- MA SITUATION FAMILIALE -->
      <label for="situationFamiliale" class="col-12 col-md-4 fw-bold text-start">Je suis :</label>
      <div class="select2-selection--single col-12 col-md-8">
        <select id="situationFamiliale" name="situationFamiliale" class="form-select form-input col-12" data-type="select">
          <option value="" selected disabled>Sélectionner</option>
          <option value="celibataire">Célibataire</option>
          <option value="marie" data-type="contrat">Marié(e) contrat de mariage</option>
          <option value="marie" data-type="communaute">Marié(e) communauté de biens</option>
          <option value="divorce">Divorcé(e)</option>
          <option value="veuf">Veuf(ve)</option>
          <option value="pacse">Pacsé(e)</option>
          <option value="union">Union libre</option>
          <option value="instance-divorce" data-type="instance">En instance de divorce</option>
        </select>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-situationFamiliale">
          <p>Veuillez choisir parmi les champs proposés</p>
        </div>

      </div>

      <!-- Date de jugement du divorce -->
      <label for="dateDivorce" class="col-12 col-md-4 fw-bold text-start mt-4 d-none" id="dateDivorceLabel">Date de jugement du divorce : <br><small class="smallLabel">(JJ/MM/AAAA)</small> </label>
      <div class="select2-selection--single col-12 col-md-8 mt-4 d-none" id="dateDivorceContainer">
        <div class="input-group">
          <input type="text" id="dateDivorce" name="dateDivorce" class="form-control date-input form-input col-12" placeholder="JJ/MM/AAAA" data-type="dateFr">
          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        </div>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-dateDivorce">
          <p>Veuillez mettre une date</p>
        </div>
      </div>

      <!-- Enfants à charge -->
      <label for="nbEnfant" class="col-12 col-md-4 fw-bold text-start mt-4">Enfant(s) à charge :</label>
      <div class="select2-selection--single col-12 col-md-8 mt-4">
        <div class="input-group">
          <input class="numberstyle form-input text-center" id="nbEnfant" type="text" inputmode="numeric" pattern="[0-9]*" min="0" max="100" step="1" value="0" name="nbEnfant" data-type="integer">
        </div>
        <div class="col-12 error-container text-start mt-3" style="display:none" id="error-nbEnfant">
          <p>Ce champ doit être supérieur à zéro</p>
        </div>
      </div>
    </div>
  </div>
  <div class="btnForm btn-form-situationfamilliale mt-5">
    <div class="row justify-content-center justify-content-md-end">
      <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
      <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
    </div>
  </div>
</div>


<script>
  document.addEventListener("DOMContentLoaded", () => {
  // Récupérer les éléments nécessaires
  const situationFamilialeSelect = document.getElementById('situationFamiliale');
  const dateDivorceLabel = document.getElementById('dateDivorceLabel');
  const dateDivorceContainer = document.getElementById('dateDivorceContainer');

  // Fonction pour gérer l'affichage du champ date de divorce
  function handleSituationFamilialeChange() {
    const selectedValue = situationFamilialeSelect.value;
    
    if (selectedValue === 'divorce') {
      dateDivorceLabel.classList.remove('d-none');
      dateDivorceContainer.classList.remove('d-none');
    } else {
      dateDivorceLabel.classList.add('d-none');
      dateDivorceContainer.classList.add('d-none');
    }
  }

  // Ajouter l'événement change sur le select
  situationFamilialeSelect.addEventListener('change', handleSituationFamilialeChange);

  // Appeler la fonction au chargement pour gérer l'état initial
  handleSituationFamilialeChange();
});

</script>