const options = {
  public: {
    statut: {
      show: true,
      order: 2,
      values: [
        { value: "agent_service", text: "Agent de service" },
        { value: "agent_public", text: "Agent public" },
        { value: "aide_soignant", text: "Aide soignant hospitalier" },
        { value: "cadre_moyen", text: "Cadre moyen instituteur" },
        { value: "cadre_superieur", text: "Cadre supérieur et professeur" },
        { value: "employe_administratif", text: "Employé et agent administratif" },
        { value: "infirmiere_paramedical", text: "Infirmière et profession paramédicale" },
        { value: "ouvrier_etat", text: "Ouvrier d'Etat" }
      ]
    },
    typeContrat: {
      show: true,
      order: 4,
      values: [
        { value: "cdi", text: "CDI" },
        { value: "cdi_essai", text: "CDI période d'essai non terminée" },
        { value: "cdd", text: "CDD" },
        { value: "stage", text: "Stage" },
        { value: "interim", text: "Intérim" },
        { value: "autres", text: "Autres" }
      ]
    },
    profession: {
      show: true,
      order: 3
    },
    dateDebut: {
      show: true,
      order: 5
    },
    secteurActivite: {
      show: true,
      order: 1
    }
  },
  prive: {
    statut: {
      show: true,
      order: 2,
      values: [
        { value: "cadre_superieur", text: "Cadre supérieur" },
        { value: "cadre_moyen", text: "Cadre moyen" },
        { value: "ingenieur", text: "Ingénieur" },
        { value: "technicien", text: "Technicien" },
        { value: "contremaitre", text: "Contremaître - Agent de maîtrise" },
        { value: "agent_securite", text: "Agent de sécurité" },
        { value: "employe_commerce", text: "Employé de commerce" },
        { value: "assistante_maternelle", text: "Assistante maternelle - Employé de maison" },
        { value: "employe_garage", text: "Employé de garage - apporteur" },
        { value: "employe_bureau", text: "Employé de bureau" },
        { value: "vendeur", text: "Vendeur - Caissier de magasin" },
        { value: "ouvrier", text: "Ouvrier" },
        { value: "representant_salarie", text: "Représentant salarié" },
        { value: "chauffeur_livreur", text: "Chauffeur et livreur" },
        { value: "dirigeant", text: "Dirigeant de société" }
      ]
    },
    typeContrat: {
      show: true,
      order: 4,
      values: [
        { value: "cdi", text: "CDI" },
        { value: "cdi_essai", text: "CDI période d'essai non terminée" },
        { value: "cdd", text: "CDD" },
        { value: "stage", text: "Stage" },
        { value: "interim", text: "Intérim" },
        { value: "autres", text: "Autres" }
      ]
    },
    profession: {
      show: true,
      order: 3
    },
    dateDebut: {
      show: true,
      order: 5
    },
    secteurActivite: {
      show: true,
      order: 1
    }
  },
  agricole: {
    statut: {
      show: true,
      order: 2,
      values: [
        { value: "proprietaire_agricole", text: "Propriétaire agricole" },
        { value: "salarie_agricole", text: "Salarié agricole" }
      ]
    },
    typeContrat: {
      show: false, // Initialement caché
      order: 4,
      values: [
        { value: "cdi", text: "CDI" },
        { value: "cdi_essai", text: "CDI période d'essai non terminée" },
        { value: "cdd", text: "CDD" },
        { value: "stage", text: "Stage" },
        { value: "interim", text: "Intérim" },
        { value: "autres", text: "Autres" }
      ]
    },
    profession: {
      show: true,
      order: 3
    },
    dateDebut: {
      show: true,
      order: 5
    },
    secteurActivite: {
      show: true,
      order: 1
    }
  },
  artisans: {
    statut: {
      show: true,
      order: 2,
      values: [
        { value: "artisan", text: "Artisan" },
        { value: "commercant", text: "Commerçant" },
        { value: "vrp_sans_fixe", text: "VRP sans fixe" }
      ]
    },
    typeContrat: {
      show: false,
      order: 0
    },
    profession: {
      show: true,
      order: 3
    },
    dateDebut: {
      show: true,
      order: 4
    },
    secteurActivite: {
      show: true,
      order: 1
    }
  },
  liberales: {
    statut: {
      show: true,
      order: 2,
      values: [
        { value: "profession_liberale", text: "Profession libérale" },
        { value: "profession_liberale_medicale", text: "Profession libérale médicale" }
      ]
    },
    typeContrat: {
      show: false,
      order: 0
    },
    profession: {
      show: true,
      order: 3
    },
    dateDebut: {
      show: true,
      order: 4
    },
    secteurActivite: {
      show: true,
      order: 1
    }
  },
  retraites: {
    statut: {
      show: true,
      order: 2,
      values: [
        { value: "etudiant", text: "Étudiant" },
        { value: "retraite_prive", text: "Retraité du secteur privé" },
        { value: "retraite_public", text: "Retraité du secteur public" },
        { value: "demandeur_emploi", text: "Demandeur d'emploi" },
        { value: "invalidite_pensionne", text: "Invalidité et pensionné" },
        { value: "sans_profession", text: "Sans profession" }
      ]
    },
    typeContrat: {
      show: false,
      order: 0
    },
    profession: {
      show: true,
      order: 3
    },
    dateDebut: {
      show: true,
      order: 4
    },
    secteurActivite: {
      show: true,
      order: 1
    }
  }
};


document.addEventListener("DOMContentLoaded", () => {
  const occupationField = document.getElementById("occupationField");
  const selectedLogement = document.querySelector('input[name="logement"]:checked');
  console.log(occupationField);
  console.log(selectedLogement);

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
  document.getElementById('secteurActivite').addEventListener('change', () => formValidatorInstance.updateOptions());
  document.getElementById('statut').addEventListener('change', () => formValidatorInstance.updateContractOptions());

  // Afficher l'étape actuelle au chargement
  formValidatorInstance.showCurrentStep();
});

class FormValidator {
  constructor(stepsSelector, nextButtonSelector, prevButtonSelector, summarySelector) {
    this.steps = document.querySelectorAll(stepsSelector);
    this.nextButtons = document.querySelectorAll(nextButtonSelector);
    this.prevButtons = document.querySelectorAll(prevButtonSelector);
    this.summary = document.querySelector(summarySelector);
    this.currentStepIndex = 0;
    this.formData = {};
    this.currentYear = new Date().getFullYear();
    this.userInteracted = false; // Nouveau flag pour suivre les interactions de l'utilisateur
    this.nextClicked = false; // Flag pour suivre le clic sur le bouton "Suivant"
    this.setupEventListeners();
  }

  // Méthode pour mettre à jour les options de sélection
  updateOptions() {
    const secteurActivite = document.getElementById('secteurActivite').value;
    const containers = {
      statut: document.getElementById('statutContainer'),
      profession: document.getElementById('professionContainer'),
      typeContrat: document.getElementById('typeContratContainer'),
      dateDebut: document.getElementById('dateDebutContainer')
    };

    const inputs = {
      statut: document.getElementById('statut'),
      profession: document.getElementById('profession'),
      typeContrat: document.getElementById('typeContrat')
    };

    inputs.statut.innerHTML = '<option value="">Sélectionner</option>';
    inputs.profession.value = "";
    inputs.typeContrat.innerHTML = '<option value="">Sélectionner</option>';

    if (options[secteurActivite]) {
      if (options[secteurActivite].statut.show) {
        options[secteurActivite].statut.values.forEach(option => {
          inputs.statut.innerHTML += `<option value="${option.value}">${option.text}</option>`;
        });
      }

      Object.values(containers).forEach(container => container.classList.add('d-none'));

      const fieldsToShow = Object.keys(options[secteurActivite]).map(key => ({
        field: key,
        ...options[secteurActivite][key]
      })).filter(fieldConfig => fieldConfig.show);

      fieldsToShow.sort((a, b) => a.order - b.order);

      fieldsToShow.forEach(fieldConfig => {
        if (fieldConfig.field !== "secteurActivite") {
          containers[fieldConfig.field].classList.remove('d-none');
        }
      });
    } else {
      Object.values(containers).forEach(container => container.classList.add('d-none'));
    }
  }

  // Méthode pour mettre à jour les options de contrat
  updateContractOptions() {
    const secteurActivite = document.getElementById('secteurActivite').value;
    const statut = document.getElementById('statut').value;
    const typeContratContainer = document.getElementById('typeContratContainer');

    if (secteurActivite === 'agricole' && statut === 'salarie_agricole') {
      typeContratContainer.classList.remove('d-none');
    } else {
      typeContratContainer.classList.add('d-none');
    }
  }

  // Méthode pour afficher les erreurs pour un champ
  showError(field) {
    // Ajouter la classe 'error-form' au champ pour indiquer une erreur
    field.classList.add("error-form");

    // Trouver le conteneur du message d'erreur correspondant
    const errorContainerId = `error-${field.name}`;
    const errorContainer = document.getElementById(errorContainerId);

    // Si le conteneur de l'erreur existe, enlever la classe 'd-none' pour afficher le message d'erreur
    if (errorContainer) {
      errorContainer.classList.remove("d-none");
    } else {
      console.error(`Conteneur d'erreur non trouvé pour ${field.name}`);
    }
  }

  // Méthode pour masquer les erreurs pour un champ
  hideError(field) {
    // Retirer la classe 'error-form' du champ
    field.classList.remove("error-form");

    // Trouver le conteneur du message d'erreur correspondant
    const errorContainerId = `error-${field.name}`;
    const errorContainer = document.getElementById(errorContainerId);

    // Si le conteneur de l'erreur existe, ajouter la classe 'd-none' pour masquer le message d'erreur
    if (errorContainer) {
      errorContainer.classList.add("d-none");
    }
  }

  // Méthode pour valider un champ
  validateField(field) {
    if (!this.isVisible(field)) {
      return true; // Ignorer la validation si le champ n'est pas visible
    }

    let isValid = true;

    if (field.hasAttribute("required") && field.value.trim() === "") {
      isValid = false;
    }

    switch (field.dataset.type) {
      case 'email':
        isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value);
        break;
      case 'tel':
        isValid = /^\d{10}$/.test(field.value.replace(/\s/g, ""));
        break;
      case 'integer':
        const intValue = field.value.trim().replace(/\s/g, '');
        const intMin = field.hasAttribute("min") ? parseInt(field.getAttribute("min"), 10) : 200;
        const intMax = field.hasAttribute("max") ? parseInt(field.getAttribute("max"), 10) : 1000000;
        isValid = intValue !== "" && !isNaN(intValue) && Number(intValue) >= intMin && Number(intValue) <= intMax;
        break;
      case 'duration':
        const durationValue = field.value.trim().replace(/\s/g, '');
        isValid = durationValue !== "" && !isNaN(durationValue) && Number(durationValue) >= 1 && Number(durationValue) <= 12;
        break;
      case 'dateTwo':
        const dateTwoValue = field.value.trim();
        const dateTwoNumber = parseInt(dateTwoValue, 10);
        isValid = !isNaN(dateTwoNumber) && dateTwoNumber >= 1 && dateTwoNumber <= 12 && dateTwoValue.length <= 2;
        break;
      case 'dateFour':
        const dateFourValue = parseInt(field.value, 10);
        isValid = !isNaN(dateFourValue) && dateFourValue >= 1900 && dateFourValue <= this.currentYear;
        break;
      case 'dateFr':
        isValid = /^\d{2}\/\d{2}\/\d{4}$/.test(field.value) && this.isValidDate(field.value);
        break;
      case 'select':
        isValid = field.value.trim() !== "";
        break;
      case 'checkbox':
        isValid = field.checked;
        break;
      case 'radio':
        isValid = Array.from(document.querySelectorAll(`input[name="${field.name}"]`)).some(radio => radio.checked);
        break;
      case 'string':
        const stringMinLength = field.getAttribute("minlength") || 0;
        const stringMaxLength = field.getAttribute("maxlength") || 255;
        isValid = field.value.length >= stringMinLength && field.value.length <= stringMaxLength && /^[a-zA-Z\s]*$/.test(field.value);
        break;
      default:
        break;
    }

    if (this.nextClicked) {
      if (isValid) {
        this.hideError(field);
      } else {
        this.showError(field);
      }
    } else {
      this.hideError(field);
    }

    return isValid;
  }

  // Méthode pour vérifier si une date est valide
  isValidDate(dateString) {
    const [day, month, year] = dateString.split('/').map(Number);
    const date = new Date(year, month - 1, day);
    return date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;
  }

  // Méthode pour ajouter des écouteurs d'événements
  setupEventListeners() {
    this.steps.forEach((step) => {
      step.addEventListener("input", (event) => {
        const field = event.target.closest("input, select, textarea");
        if (field) {
          this.userInteracted = true;
          if (this.nextClicked) {
            this.validateField(field);
          }
        }
      });

      step.addEventListener("change", (event) => {
        const field = event.target.closest('input[type="radio"], select');
        if (field) {
          this.userInteracted = true;
          if (this.nextClicked) {
            this.validateField(field);
          }
        }
      });

      step.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
          event.preventDefault();
        }
      });
    });

    // Événement de clic sur le bouton 'Suivant'
    this.nextButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        this.nextClicked = true;  // Marquer que le bouton 'Suivant' a été cliqué pour commencer la validation et l'affichage des erreurs
        const stepIsValid = this.validateStep(this.currentStepIndex);
        if (!stepIsValid) {
          event.preventDefault();
          this.showErrorsForCurrentStep();  // Montrer les erreurs pour l'étape courante si elle n'est pas valide
        } else {
          // Si l'étape est valide, passer à l'étape suivante et réinitialiser le drapeau 'nextClicked'
          this.nextClicked = false;
          this.saveStepData(this.currentStepIndex);  // Sauvegarder les données si valide
          this.goToStep(1);  // Fonction pour naviguer à l'étape suivante
        }
      });
    });

    this.prevButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        this.nextClicked = false;
        goToStep(-1);
      });
    });
  }

  // Méthode pour afficher les erreurs pour l'étape actuelle
  showErrorsForCurrentStep() {
    const step = this.steps[this.currentStepIndex];
    if (!step) {
      console.error("Étape actuelle non trouvée:", this.currentStepIndex);
      return;
    }
    const fields = step.querySelectorAll("input, select, textarea");
    fields.forEach((field) => {
      if (!this.validateField(field)) {
        this.showError(field); // Afficher les erreurs seulement si le champ est invalide
      } else {
        this.hideError(field); // Masquer les erreurs si le champ est valide
      }
    });
  }

  // Méthode pour valider l'étape actuelle
  validateStep(stepIndex) {
    const step = this.steps[stepIndex];
    if (!step) {
      console.error("Étape non trouvée");
      return false;
    }
    let isValid = true;
    const fields = step.querySelectorAll("input, select, textarea");
    fields.forEach((field) => {
      if (this.isVisible(field) && !this.validateField(field)) {
        isValid = false;
      }
    });
    return isValid;
  }

  // Méthode pour afficher l'étape actuelle
  showCurrentStep() {
    this.steps.forEach((step, index) => {
      if (index === this.currentStepIndex) {
        step.style.display = 'block';
      } else {
        step.style.display = 'none';
      }
    });
  }

  // Méthode pour sauvegarder les données de l'étape actuelle
  saveStepData(stepIndex) {
    const step = this.steps[stepIndex];
    if (!step) {
      console.error("Étape non trouvée");
      return;
    }
    const fields = step.querySelectorAll("input, select, textarea");
    fields.forEach((field) => {
      if (this.isVisible(field)) {
        this.formData[field.name] = field.value;
      }
    });
  }

  // Méthode pour afficher le résumé des données
  displaySummary() {
    if (!this.summary) return;
    this.summary.innerHTML = "";
    for (const [key, value] of Object.entries(this.formData)) {
      const p = document.createElement("p");
      p.textContent = `${key}: ${value}`;
      this.summary.appendChild(p);
    }
  }

  // Méthode pour vérifier si un élément est visible
  isVisible(element) {
    return !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
  }

  // Méthode pour aller à l'étape suivante ou précédente
  goToStep(stepChange) {
    this.currentStepIndex += stepChange;
    this.showCurrentStep();
  }

  // Méthode statique pour initialiser le validateur
  static init() {
    var styleSheet = document.createElement("style");
    styleSheet.type = "text/css";
    styleSheet.innerText = `
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance:textfield;
    }
  `;
    document.head.appendChild(styleSheet);

   
    function gestionAffichageChampValeur() {
      var inputVal = parseFloat($("#nbBien").val());
      var valeurBiens = $("#valeur_biens");

      if (valeurBiens.length) {
        if (inputVal > 0) {
          valeurBiens.css("display", "block");
          valeurBiens.removeClass("d-none");
        } else {
          valeurBiens.css("display", "none");
          valeurBiens.addClass("d-none");
        }
      }
    }

    $(".qty-add").click(function () {
      gestionAffichageChampValeur();
    });

    $(".qty-rem").click(function () {
      gestionAffichageChampValeur();
    });

    $("#nbBien").change(function () {
      gestionAffichageChampValeur();
    });

    const professionSelect = document.getElementById('profession');
    const statutGroupFonctionnaire = document.querySelector("[data-specific-group='fonctionnaire']");
    const statutGroupSalariePrive = document.querySelector("[data-specific-group='salarié_privé']");
    const professionGroupLiberale = document.querySelector("[data-specific-group='profession_libérale']");
    const depuisGroup = document.getElementById('depuis-group');
    const statutAutreGroup = document.getElementById('statutAutre-group');

    const allGroups = [statutGroupFonctionnaire, statutGroupSalariePrive, professionGroupLiberale, depuisGroup, statutAutreGroup];

    allGroups.forEach(group => {
      if (group && group.style) {
        group.style.display = 'none';
      }
    });

    function toggleVisibility(element, isVisible) {
      if (!element) {
        return;
      }

      if (typeof element.style === 'undefined') {
        return;
      }

      element.style.display = isVisible ? 'block' : 'none';
    }

    function handleProfessionChange(profession) {
      allGroups.forEach(group => toggleVisibility(group, false));

      switch (profession) {
        case 'fonctionnaire':
          toggleVisibility(statutGroupFonctionnaire, true);
          break;
        case 'salarié_privé':
          toggleVisibility(statutGroupSalariePrive, true);
          break;
        case 'profession_libérale':
          toggleVisibility(professionGroupLiberale, true);
          toggleVisibility(depuisGroup, true);
          break;
        case 'chef_entreprise':
        case 'artisan_commerçant':
        case 'retraité':
        case 'sans_emploi':
          toggleVisibility(depuisGroup, true);
          break;
        case 'autre':
          toggleVisibility(statutAutreGroup, true);
          break;
      }
    }
    if (professionSelect) {
      professionSelect.addEventListener('change', function () {
        handleProfessionChange(this.value);
      });

      handleProfessionChange(professionSelect.value);
    }

    function updateRevenusLabels(profession) {
      let textLabelSalaire = 'Mon salaire net mensuel avant impôt :';
      let textParagrapheSalaire = '';
      let textLabelAutresRevenus = 'Mes autres revenus mensuels :';
      let textParagrapheAutresRevenus = '(Locatifs, allocations, pensions alimentaires…)';

      switch (profession) {
        case 'fonctionnaire':
        case 'salarié_privé':
          textLabelSalaire = 'Mon salaire net mensuel avant impôt :';
          textParagrapheSalaire = 'Ajoutez vos primes ou 13ème mois dans ce montant (ex de calcul : (Salaire net annuel avant impôt + 13ème mois) ÷ 12)';
          break;
        case 'profession_libérale':
        case 'artisan_commerçant':
          textLabelSalaire = 'Mes revenus déclarés ou BNC';
          textParagrapheSalaire = '(Revenu annuel avant impôt ÷ 12)';
          break;
        case 'chef_entreprise':
          textLabelSalaire = 'Mon revenu net mensuel avant impôt : ';
          textParagrapheSalaire = '(Revenu annuel avant impôt ÷ 12)';
          break;
        case 'retraité':
          textLabelSalaire = 'Mes pensions de retraite mensuelles';
          break;
        case 'sans_emploi':
          textLabelSalaire = 'Mes indemnités mensuelles : ';
          textParagrapheSalaire = '(Chômage, sécurité sociale…)';
          break;
        case 'autre':
          textLabelSalaire = 'Mes revenus nets mensuels';
          break;
      }

      if (document.querySelector('.labelSalaire') && document.querySelector('.labelAutresRevenus')) {
        document.querySelector('.labelSalaire').innerHTML = textLabelSalaire + (textParagrapheSalaire ? `<p class="afterLabel">${textParagrapheSalaire}</p>` : '');
        document.querySelector('.labelAutresRevenus').innerHTML = textLabelAutresRevenus + `<p class="afterLabel">${textParagrapheAutresRevenus}</p>`;
      }
    }

    professionSelect.addEventListener('change', function () {
      updateRevenusLabels(this.value);
    });

    updateRevenusLabels(professionSelect.value);

    const professionCoSelect = document.getElementById('professionCo');
    const statutFonctionnaireCoGroup = document.querySelector("[data-specific-group='fonctionnaire_co']");
    const statutSalariePriveCoGroup = document.querySelector("[data-specific-group='salarié_privé_co']");
    const professionLiberaleCoGroup = document.querySelector("[data-specific-group='profession_libérale_co']");
    const depuisCoGroup = document.getElementById('depuisCo-group');
    const statutAutreCoGroup = document.getElementById('statutCoAutre-group');

    const allCoGroups = [statutFonctionnaireCoGroup, statutSalariePriveCoGroup, professionLiberaleCoGroup, depuisCoGroup, statutAutreCoGroup];

    allCoGroups.forEach(group => {
      if (group && group.style) {
        group.style.display = 'none';
      }
    });

    function toggleVisibilityCo(group, isVisible) {
      if (group && group.style) {
        group.style.display = isVisible ? 'block' : 'none';
      }
    }

    function handleProfessionCoChange(profession) {
      allCoGroups.forEach(group => toggleVisibilityCo(group, false));

      switch (profession) {
        case 'fonctionnaire':
          toggleVisibilityCo(statutFonctionnaireCoGroup, true);
          break;
        case 'salarié_privé':
          toggleVisibilityCo(statutSalariePriveCoGroup, true);
          break;
        case 'profession_libérale':
          toggleVisibilityCo(professionLiberaleCoGroup, true);
          toggleVisibilityCo(depuisCoGroup, true);
          break;
        case 'chef_entreprise':
        case 'artisan_commerçant':
        case 'retraité':
        case 'sans_emploi':
          toggleVisibilityCo(depuisCoGroup, true);
          break;
        case 'autre':
          toggleVisibilityCo(statutAutreCoGroup, true);
          break;
      }
    }

    if (professionCoSelect) {
      professionCoSelect.addEventListener('change', function () {
        handleProfessionCoChange(this.value);
      });

      handleProfessionCoChange(professionCoSelect.value);
    }

    function updateRevenusCoLabels(profession) {
      let textLabelSalaireCo = 'Son salaire net mensuel avant impôt :';
      let textParagrapheSalaireCo = '';
      let textLabelAutresRevenusCo = 'Ses autres revenus mensuels :';
      let textParagrapheAutresRevenusCo = '(Locatifs, allocations, pensions alimentaires…)';

      switch (profession) {
        case 'fonctionnaire':
        case 'salarié_privé':
          textLabelSalaireCo = 'Son salaire net mensuel avant impôt :';
          textParagrapheSalaireCo = 'Ajoutez vos primes ou 13ème mois dans ce montant (ex de calcul : (Salaire net annuel avant impôt + 13ème mois) ÷ 12)';
          break;
        case 'profession_libérale':
        case 'artisan_commerçant':
          textLabelSalaireCo = 'Ses revenus déclarés ou BNC';
          textParagrapheSalaireCo = '(Revenu annuel avant impôt ÷ 12)';
          break;
        case 'chef_entreprise':
          textLabelSalaireCo = 'Son revenu net mensuel avant impôt : ';
          textParagrapheSalaireCo = '(Revenu annuel avant impôt ÷ 12)';
          break;
        case 'retraité':
          textLabelSalaireCo = 'Ses pensions de retraite mensuelles';
          break;
        case 'sans_emploi':
          textLabelSalaireCo = 'Ses indemnités mensuelles : ';
          textParagrapheSalaireCo = '(Chômage, sécurité sociale…)';
          break;
        case 'autre':
          textLabelSalaireCo = 'Ses revenus nets mensuels';
          break;
      }

      if (document.querySelector('.labelSalaireCo') && document.querySelector('.labelAutresRevenusCo')) {
        document.querySelector('.labelSalaireCo').innerHTML = textLabelSalaireCo + (textParagrapheSalaireCo ? `<p class="afterLabel">${textParagrapheSalaireCo}</p>` : '');
        document.querySelector('.labelAutresRevenusCo').innerHTML = textLabelAutresRevenusCo + `<p class="afterLabel">${textParagrapheAutresRevenusCo}</p>`;
      }
    }

    professionCoSelect.addEventListener('change', function () {
      updateRevenusCoLabels(this.value);
    });

    updateRevenusCoLabels(professionCoSelect.value);

    var closeModalIcons = document.querySelectorAll('.close-modal, .fa-circle-xmark:before');
    closeModalIcons.forEach(function (icon) {
      icon.addEventListener('click', function () {
        var modalEl = document.getElementById('ModalSave');
        if (modalEl) {
          var modalInstance = bootstrap.Modal.getInstance(modalEl);
          if (modalInstance) {
            modalInstance.hide();
          }
        }
      });
    });

    var redirectionLink = document.getElementById('redirection');
    if (redirectionLink) {
      redirectionLink.addEventListener('click', function () {
        window.location.href = 'https://www.solutis.fr';
      });
    }

    function adjustFooterPosition() {
      const footerButtons = document.querySelectorAll('.btnForm');
      const windowHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;

      if (window.innerWidth <= 768) {
        footerButtons.forEach((button) => {
          if (documentHeight > windowHeight) {
            button.classList.remove('fixed-bottom');
            button.classList.add('relative-bottom');
          } else {
            button.classList.add('fixed-bottom');
            button.classList.remove('relative-bottom');
          }
        });
      } else {
        footerButtons.forEach((button) => {
          button.classList.remove('fixed-bottom');
          button.classList.remove('relative-bottom');
        });
      }
    }

    adjustFooterPosition();
    window.addEventListener('resize', adjustFooterPosition);

    const inputs = document.querySelectorAll('input[type="number"], input[type="tel"]');

    inputs.forEach(input => {
      input.addEventListener('input', function (e) {
        const value = this.value.replace(/[^\d]/g, '');
        this.value = value;
      });
    });

    window.addEventListener('wheel', function (event) {
      if (event.ctrlKey) {
        event.preventDefault();
      }
    }, { passive: false });

    window.addEventListener('keydown', function (event) {
      if ((event.ctrlKey || event.metaKey) && (event.key === '+' || event.key === '-' || event.key === '0')) {
        event.preventDefault();
      }
    });

    const telephoneInput = document.getElementById('telephone');
    telephoneInput.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D+/g, '');
      if (value && value[0] !== '0') {
        value = '0' + value.substring(1, 10);
      } else {
        value = value.substring(0, 10);
      }
      value = value.replace(/(\d{2})(?=\d)/g, '$1 ');
      e.target.value = value;
    });

    function adaptDateInputsForMobile() {
      const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
      if (isMobile) {
        const dateInputs = document.querySelectorAll('input[type="text"].date-input');

        dateInputs.forEach(function (input) {
          input.setAttribute('type', 'tel');
          input.placeholder = 'JJ/MM/AAAA';
        });
      }
    }

    adaptDateInputsForMobile();

    const natureLabels = document.querySelectorAll('.nature-label');
    const errorContainerNature = document.getElementById('error-travaux');

    natureLabels.forEach(label => {
      label.addEventListener('click', function () {
        natureLabels.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
        if (errorContainerNature) errorContainerNature.classList.add('d-none');
        formValidatorInstance.goToStep(1);
      });
    });

    function validateNatureSelection() {
      const selectedNature = document.querySelector('.nature-label.active');
      if (!selectedNature) {
        if (errorContainerNature) errorContainerNature.classList.remove('d-none');
        return false;
      }
      if (errorContainerNature) errorContainerNature.classList.add('d-none');
      return true;
    }

    const btnNextNature = document.querySelector('#btnNextNature');
    if (btnNextNature) {
      btnNextNature.addEventListener('click', function (e) {
        if (!validateNatureSelection()) {
          e.preventDefault();
        } else {
          formValidatorInstance.goToStep(1);
        }
      });
    }
  }
}

