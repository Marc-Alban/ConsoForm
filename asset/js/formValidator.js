$(document).ready(function () {
  $('.input-number').on('input', function (e) {
    var input = $(this).val().replace(/[^\d]/g, '');
    var formatted = input.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    $(this).val(formatted);

    var valid = /^\d+( \d{3})*$/.test(formatted);
    var isZero = (input === '0');
    var name = $(this).attr('name');

    var nameWithoutBrackets = name.replace(/[()\[\]]/g, '');
    var errorId = '#error-' + nameWithoutBrackets;
    var $inputGroupText = $(this).siblings('.input-group-text');

    if (!valid || isZero) {
      $(errorId).show();
    } else {
      $(errorId).hide();
    }
  });
});

const options = {
  'prive': {
    statut: { show: true },
    profession: { show: true },
    typeContrat: { show: true },
    dateDebut: { show: true }
  },
  'public': {
    statut: { show: true },
    profession: { show: true },
    typeContrat: { show: true },
    dateDebut: { show: true }
  },
  'agricole': {
    statut: { show: true },
    profession: { show: true },
    typeContrat: { show: true },
    dateDebut: { show: true }
  },
  'artisans': {
    statut: { show: true },
    profession: { show: true },
    typeContrat: { show: false },
    dateDebut: { show: true }
  },
  'liberales': {
    statut: { show: true },
    profession: { show: true },
    typeContrat: { show: false },
    dateDebut: { show: true }
  },
  'retraites': {
    statut: { show: true },
    profession: { show: true },
    typeContrat: { show: false },
    dateDebut: { show: false }
  }
};

const contrats = {
  'prive': ['CDI', 'CDI (période d\'essai non terminée)', 'CDD', 'Stage', 'Intérim', 'Autres'],
  'public': ['CDI', 'CDI (période d\'essai non terminée)', 'CDD', 'Stage', 'Intérim', 'Autres'],
  'agricole': ['CDI', 'CDI (période d\'essai non terminée)', 'CDD', 'Stage', 'Intérim', 'Autres']
};

class FormValidator {
  constructor(stepsSelector, nextButtonSelector, prevButtonSelector, summarySelector) {
    this.steps = document.querySelectorAll(stepsSelector);
    this.nextButtons = document.querySelectorAll(nextButtonSelector);
    this.prevButtons = document.querySelectorAll(prevButtonSelector);
    this.summary = document.querySelector(summarySelector);
    this.currentStepIndex = 0;
    this.formData = {};
    this.currentYear = new Date().getFullYear();
    this.userInteracted = false;
    this.nextClicked = false;
    this.setupEventListeners();
  }

  setupEventListeners() {
    document.getElementById('secteurActivite').addEventListener('change', (event) => {
      this.changeSelect(event.target.value, document.getElementById('statut'));
      this.updateOptions();
      this.hideError(event.target);
    });

    document.getElementById('statut').addEventListener('change', (event) => {
      this.contractType(event);
      this.updateContractOptions();
      this.hideError(event.target);
    });

    document.getElementById('secteurActiviteCo').addEventListener('change', (event) => {
      this.changeSelectCo(event.target.value, document.getElementById('statutCo'));
      this.updateOptionsCo();
      this.hideError(event.target);
    });

    document.getElementById('statutCo').addEventListener('change', (event) => {
      this.contractTypeCo(event);
      this.updateContractOptionsCo();
      this.hideError(event.target);
    });

    this.steps.forEach(step => {
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

    this.nextButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        this.nextClicked = true;
        const stepIsValid = this.validateStep(this.currentStepIndex);
        if (!stepIsValid) {
          event.preventDefault();
          this.showErrorsForCurrentStep();
          return;
        }
        this.nextClicked = false;
        this.saveStepData(this.currentStepIndex);
        this.currentStepIndex++;
        this.showCurrentStep();
      });
    });

    this.prevButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        this.nextClicked = false;
        if (this.currentStepIndex > 0) {
          this.currentStepIndex--;
          this.showCurrentStep();
        }
      });
    });

    const radioButtons = document.querySelectorAll('.hidden-input');
    radioButtons.forEach(radio => {
      radio.addEventListener('change', () => {
        const errorContainerProjet = document.getElementById('error-projet');
        if (radio.checked) {
          errorContainerProjet.style.display = 'none';
        }
      });
    });
  }

  formatNumberWithSpaces(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
  }

  synchronizeValues(textInput, numberInput) {
    const rawValue = numberInput.value.replace(/[^\d]/g, '');
    const formattedValue = this.formatNumberWithSpaces(rawValue);
    textInput.value = formattedValue;
    numberInput.value = rawValue;

    textInput.setAttribute('min', numberInput.getAttribute('data-min'));
    textInput.setAttribute('max', numberInput.getAttribute('data-max'));

    this.validateField(numberInput);
  }

  setupFormattedNumberInputs() {
    document.querySelectorAll('.input-number').forEach(numberInput => {
      if (!numberInput.nextElementSibling || numberInput.nextElementSibling.tagName !== 'INPUT') {
        const textInput = document.createElement('input');
        textInput.type = 'text';
        textInput.className = numberInput.className.replace('input-number', '');
        textInput.placeholder = numberInput.placeholder;
        textInput.setAttribute('data-hidden-input', numberInput.id);
        textInput.setAttribute('data-min', numberInput.getAttribute('data-min'));
        textInput.setAttribute('data-max', numberInput.getAttribute('data-max'));

        numberInput.style.opacity = '0';
        numberInput.style.position = 'absolute';

        textInput.setAttribute('id', 'clone-' + numberInput.name);

        numberInput.parentNode.insertBefore(textInput, numberInput.nextSibling);
        this.synchronizeValues(textInput, numberInput);

        textInput.addEventListener('input', () => {
          const input = textInput.value.replace(/[^\d]/g, '');
          const formatted = this.formatNumberWithSpaces(input);
          textInput.value = formatted;
          numberInput.value = input;
          this.validateField(numberInput);
        });
      }
    });
  }

  selectContart(choix, key, select2) {
    select2.innerHTML = '<option value="">Sélectionner</option>';
    for (let i = 0; i < choix.length; i++) {
      let opt = document.createElement('option');
      opt.value = key[i];
      opt.innerHTML = choix[i];
      select2.appendChild(opt);
    }
  }

  contractType(event) {
    for (let i = 0; i < event.currentTarget.options.length; i++) {
      event.currentTarget.options[i].removeAttribute("selected");
    }
    event.currentTarget.options[event.currentTarget.options.selectedIndex].setAttribute("selected", "selected");
  }

  contractTypeCo(event) {
    for (let i = 0; i < event.currentTarget.options.length; i++) {
      event.currentTarget.options[i].removeAttribute("selected");
    }
    event.currentTarget.options[event.currentTarget.options.selectedIndex].setAttribute("selected", "selected");
  }

  changeSelect(type, select) {
    const choix1 = ['cadre supérieur', 'ingénieur', 'cadre moyen', 'technicien', 'contremaître - agent de maîtrise', 'agent de sécurité', 'Employé de commerce', 'Assistante maternelle - Employé de maison', 'Employé de garage - apporteurs', 'Employé de bureau', 'Vendeur - caissier de magasin', 'Ouvrier', 'Représentant salarié', 'Chauffeur et livreur', 'dirigeant de société'];
    const key1 = ['privateseniorexecutive', 'engineer', 'middlemanagerintheprivatesector', 'technician', 'privatesectorsupervisorskilledworker', 'securityagent', 'salespersonstorecashier', 'childminderdomesticemployee', 'garageemployeeproviders', 'officeemployee', 'salesrepresentativewithoutafixedlocation', 'workerConso', 'salariedrepresentative', 'driveranddeliveryperson', 'companydirector'];
    const choix2 = ['cadre supérieur et professeur', 'cadre moyen', 'instituteur / infirmière et profession paramédicales', 'Employé et agent administratif', 'Agent de service', 'Ouvrier d\'Etat', 'Agent public ', 'Aide soignant hospitalier'];
    const key2 = ['publicseniorexecutiveandprofessor', 'publicmiddlemanagerteacher', 'nurseandparamedicalprofession', 'administrativeemployeeandagent', 'publicserviceagent', 'publicsectoremployee', 'stateemployee', 'hospitalnursingassistant'];
    const choix3 = ['salarié agricole', 'propriétaire agricole'];
    const key3 = ['farmworker', 'farmowner'];
    const choix4 = ['artisan / commerçant'];
    const key4 = ['artisan'];
    const choix5 = ['profession libérale', 'VRP sans fixe', 'Infirmière - cadre moyen secteur médical', 'Profession libérale médicale et paramédicale'];
    const key5 = ['liberalprofession', 'salesrepresentativewithoutafixedlocation', 'middlemedicalmanager', 'medicalandparamedicalliberalprofession'];
    const choix6 = ['Etudiant', 'retraité du secteur privé', 'retraité du secteur public', 'Demandeur d\'emploi', 'Invalide et pensionné', 'Sans profession - sans emploi', 'Divers'];
    const key6 = ['student', 'privatesectorretiree', 'publicsectorretiree', 'jobseeker', 'disabledpensioner', 'inactivewithoutprofessionunemployed', 'miscellaneous'];

    switch (type) {
      case 'prive':
        this.selectContart(choix1, key1, select);
        break;
      case 'public':
        this.selectContart(choix2, key2, select);
        break;
      case 'agricole':
        this.selectContart(choix3, key3, select);
        break;
      case 'artisans':
        this.selectContart(choix4, key4, select);
        break;
      case 'liberales':
        this.selectContart(choix5, key5, select);
        break;
      case 'retraites':
        this.selectContart(choix6, key6, select);
        break;
    }
  }

  changeSelectCo(type, select) {
    const choix1 = ['cadre supérieur', 'ingénieur', 'cadre moyen', 'technicien', 'contremaître - agent de maîtrise', 'agent de sécurité', 'Employé de commerce', 'Assistante maternelle - Employé de maison', 'Employé de garage - apporteurs', 'Employé de bureau', 'Vendeur - caissier de magasin', 'Ouvrier', 'Représentant salarié', 'Chauffeur et livreur', 'dirigeant de société'];
    const key1 = ['privateseniorexecutive', 'engineer', 'middlemanagerintheprivatesector', 'technician', 'privatesectorsupervisorskilledworker', 'securityagent', 'salespersonstorecashier', 'childminderdomesticemployee', 'garageemployeeproviders', 'officeemployee', 'salesrepresentativewithoutafixedlocation', 'workerConso', 'salariedrepresentative', 'driveranddeliveryperson', 'companydirector'];
    const choix2 = ['cadre supérieur et professeur', 'cadre moyen', 'instituteur / infirmière et profession paramédicales', 'Employé et agent administratif', 'Agent de service', 'Ouvrier d\'Etat', 'Agent public ', 'Aide soignant hospitalier'];
    const key2 = ['publicseniorexecutiveandprofessor', 'publicmiddlemanagerteacher', 'nurseandparamedicalprofession', 'administrativeemployeeandagent', 'publicserviceagent', 'publicsectoremployee', 'stateemployee', 'hospitalnursingassistant'];
    const choix3 = ['salarié agricole', 'propriétaire agricole'];
    const key3 = ['farmworker', 'farmowner'];
    const choix4 = ['artisan / commerçant'];
    const key4 = ['artisan'];
    const choix5 = ['profession libérale', 'VRP sans fixe', 'Infirmière - cadre moyen secteur médical', 'Profession libérale médicale et paramédicale'];
    const key5 = ['liberalprofession', 'salesrepresentativewithoutafixedlocation', 'middlemedicalmanager', 'medicalandparamedicalliberalprofession'];
    const choix6 = ['Etudiant', 'retraité du secteur privé', 'retraité du secteur public', 'Demandeur d\'emploi', 'Invalide et pensionné', 'Sans profession - sans emploi', 'Divers'];
    const key6 = ['student', 'privatesectorretiree', 'publicsectorretiree', 'jobseeker', 'disabledpensioner', 'inactivewithoutprofessionunemployed', 'miscellaneous'];

    switch (type) {
      case 'prive':
        this.selectContart(choix1, key1, select);
        break;
      case 'public':
        this.selectContart(choix2, key2, select);
        break;
      case 'agricole':
        this.selectContart(choix3, key3, select);
        break;
      case 'artisans':
        this.selectContart(choix4, key4, select);
        break;
      case 'liberales':
        this.selectContart(choix5, key5, select);
        break;
      case 'retraites':
        this.selectContart(choix6, key6, select);
        break;
    }
  }

  updateOptions(prefix = '') {
    const secteurActiviteElement = document.getElementById(`${prefix}secteurActivite`);
    const statutElement = document.getElementById(`${prefix}statutContainer`);
    const professionElement = document.getElementById(`${prefix}professionContainer`);
    const typeContratElement = document.getElementById(`${prefix}typeContratContainer`);
    const dateDebutElement = document.getElementById(`${prefix}dateDebutContainer`);

    const secteurActivite = secteurActiviteElement ? secteurActiviteElement.value : null;

    if (!secteurActivite || !options[secteurActivite]) {
      console.error(`Options not found for secteurActivite: ${secteurActivite}`);
      return;
    }

    const secteurOptions = options[secteurActivite];
    if (statutElement) statutElement.classList.toggle('d-none', !secteurOptions.statut.show);
    if (professionElement) professionElement.classList.toggle('d-none', !secteurOptions.profession.show);
    if (typeContratElement) typeContratElement.classList.toggle('d-none', !secteurOptions.typeContrat.show);
    if (dateDebutElement) dateDebutElement.classList.toggle('d-none', !secteurOptions.dateDebut.show);

    const statutSelect = document.getElementById(`${prefix}statut`);
    if (statutSelect) this.changeSelect(secteurActivite, statutSelect);
  }

  updateOptionsCo(prefix = '') {
    const secteurActiviteElement = document.getElementById(`${prefix}secteurActiviteCo`);
    const statutElement = document.getElementById(`${prefix}statutContainerCo`);
    const professionElement = document.getElementById(`${prefix}professionContainerCo`);
    const typeContratElement = document.getElementById(`${prefix}typeContratContainerCo`);
    const dateDebutElement = document.getElementById(`${prefix}dateDebutContainerCo`);

    const secteurActivite = secteurActiviteElement ? secteurActiviteElement.value : null;

    if (!secteurActivite || !options[secteurActivite]) {
      console.error(`Options not found for secteurActivite: ${secteurActivite}`);
      return;
    }

    const secteurOptions = options[secteurActivite];
    if (statutElement) statutElement.classList.toggle('d-none', !secteurOptions.statut.show);
    if (professionElement) professionElement.classList.toggle('d-none', !secteurOptions.profession.show);
    if (typeContratElement) typeContratElement.classList.toggle('d-none', !secteurOptions.typeContrat.show);
    if (dateDebutElement) dateDebutElement.classList.toggle('d-none', !secteurOptions.dateDebut.show);

    const statutSelect = document.getElementById(`${prefix}statutCo`);
    if (statutSelect) this.changeSelectCo(secteurActivite, statutSelect);
  }

  updateContractOptions(prefix = '') {
    const secteurActiviteElement = document.getElementById(`${prefix}secteurActivite`);
    const statutElement = document.getElementById(`${prefix}statut`);
    const typeContratSelect = document.getElementById(`${prefix}typeContrat`);

    const secteurActivite = secteurActiviteElement.value;

    if (secteurActivite === 'agricole' && statutElement.value === 'salarie_agricole') {
      typeContratSelect.innerHTML = '';
      contrats['agricole'].forEach(contrat => {
        const option = document.createElement('option');
        option.value = contrat;
        option.text = contrat;
        typeContratSelect.appendChild(option);
      });
      typeContratSelect.parentElement.classList.remove('d-none');
    } else if (secteurActivite === 'agricole' && statutElement.value === 'proprietaire_agricole') {
      typeContratSelect.innerHTML = '';
      typeContratSelect.parentElement.classList.add('d-none');
    } else if (contrats[secteurActivite]) {
      typeContratSelect.innerHTML = '';
      contrats[secteurActivite].forEach(contrat => {
        const option = document.createElement('option');
        option.value = contrat;
        option.text = contrat;
        typeContratSelect.appendChild(option);
      });
      typeContratSelect.parentElement.classList.remove('d-none');
    } else {
      typeContratSelect.innerHTML = '';
      typeContratSelect.parentElement.classList.add('d-none');
    }
  }

  updateContractOptionsCo(prefix = '') {
    const secteurActiviteElement = document.getElementById(`${prefix}secteurActiviteCo`);
    const statutElement = document.getElementById(`${prefix}statutCo`);
    const typeContratSelect = document.getElementById(`${prefix}typeContratCo`);

    const secteurActivite = secteurActiviteElement.value;

    if (secteurActivite === 'agricole' && statutElement.value === 'salarie_agricole') {
      typeContratSelect.innerHTML = '';
      contrats['agricole'].forEach(contrat => {
        const option = document.createElement('option');
        option.value = contrat;
        option.text = contrat;
        typeContratSelect.appendChild(option);
      });
      typeContratSelect.parentElement.classList.remove('d-none');
    } else if (secteurActivite === 'agricole' && statutElement.value === 'proprietaire_agricole') {
      typeContratSelect.innerHTML = '';
      typeContratSelect.parentElement.classList.add('d-none');
    } else if (contrats[secteurActivite]) {
      typeContratSelect.innerHTML = '';
      contrats[secteurActivite].forEach(contrat => {
        const option = document.createElement('option');
        option.value = contrat;
        option.text = contrat;
        typeContratSelect.appendChild(option);
      });
      typeContratSelect.parentElement.classList.remove('d-none');
    } else {
      typeContratSelect.innerHTML = '';
      typeContratSelect.parentElement.classList.add('d-none');
    }
  }

  showError(field) {
    field.classList.add("error-form");
    const errorContainerId = `error-${field.name}`;
    const errorContainer = document.getElementById(errorContainerId);

    if (field.classList.contains('input-number')) {
      let name = $(field).attr('name');
      $('#clone-' + name).addClass('error-form');
    }

    if (errorContainer) {
      errorContainer.style.display = 'block';
    } else {
      console.error(`Error container not found for ${field.name}`);
    }
  }

  hideError(field) {
    field.classList.remove("error-form");
    const errorContainerId = `error-${field.name}`;
    const errorContainer = document.getElementById(errorContainerId);

    if (errorContainer) {
      errorContainer.style.display = 'none';
    }
  }

  validateField(field) {
    if (!this.isVisible(field)) {
      return true;
    }

    let isValid = true;
    const value = field.value.trim();

    if (field.hasAttribute("required") && value === "") {
      isValid = false;
    } else {
      switch (field.dataset.type) {
        case 'email':
          isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
          break;
        case 'tel':
          isValid = /^\d{10}$/.test(value.replace(/\s/g, ""));
          break;
        case 'integer':
          const numericValue = parseInt(value.replace(/\s/g, ''), 10);
          const min = field.hasAttribute("min") ? parseInt(field.getAttribute("min"), 10) : undefined;
          const max = field.hasAttribute("max") ? parseInt(field.getAttribute("max"), 10) : undefined;
          isValid = !isNaN(numericValue) && (min === undefined || numericValue >= min) && (max === undefined || numericValue <= max);
          break;
        case 'duration':
          const durationValue = parseInt(value, 10);
          isValid = !isNaN(durationValue) && durationValue >= 1 && durationValue <= 12;
          break;
        case 'dateTwo':
          const dateTwoValue = value.replace(/\s/g, '');
          isValid = dateTwoValue !== "" && /^[0-9]{1,2}$/.test(dateTwoValue) && Number(dateTwoValue) >= 1 && Number(dateTwoValue) <= 31;
          break;
        case 'dateFour':
          const dateFourValue = parseInt(value, 10);
          isValid = !isNaN(dateFourValue) && dateFourValue >= 1900 && dateFourValue <= this.currentYear;
          break;
        case 'dateFr':
          isValid = /^\d{2}\/\d{2}\/\d{4}$/.test(value) && this.isValidDate(value);
          break;
        case 'select':
          isValid = value !== "";
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

  isValidDate(dateString) {
    const [day, month, year] = dateString.split('/').map(Number);
    const date = new Date(year, month - 1, day);
    return date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;
  }

  showErrorsForCurrentStep() {
    const step = this.steps[this.currentStepIndex];
    if (!step) {
      console.error("Current step not found:", this.currentStepIndex);
      return;
    }

    const fields = step.querySelectorAll("input, select, textarea");

    fields.forEach((field) => {
      if (!this.validateField(field)) {
        this.showError(field);
      } else {
        this.hideError(field);
      }
    });
  }

  validateStep(stepIndex) {
    const step = this.steps[stepIndex];
    if (!step) {
      console.error("Step not found");
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

  saveStepData(stepIndex) {
    const step = this.steps[stepIndex];
    if (!step) {
      console.error("Step not found");
      return;
    }
    const fields = step.querySelectorAll("input, select, textarea");
    fields.forEach((field) => {
      if (this.isVisible(field)) {
        this.formData[field.name] = field.value;
      }
    });
  }

  displaySummary() {
    if (!this.summary) return;
    this.summary.innerHTML = "";
    for (const [key, value] of Object.entries(this.formData)) {
      const p = document.createElement("p");
      p.textContent = `${key}: ${value}`;
      this.summary.appendChild(p);
    }
  }

  isVisible(element) {
    return element.type !== "hidden" && (element.offsetWidth || element.offsetHeight || element.getClientRects().length);
  }

  showCurrentStep() {
    this.steps.forEach((step, index) => {
      step.style.display = index === this.currentStepIndex ? 'block' : 'none';
    });
  }

  static init() {
    const formValidatorInstance = new FormValidator(".form-container .step", ".btnNext", ".btnPrev", "#summary");
    formValidatorInstance.showCurrentStep();
  }
}

const fieldLimits = {
  'montantSouhaite': { min: 200, max: 999999999 },
  'dureeRemboursement': { min: 1, max: 12 },
};

function applyFieldLimits() {
  for (const [fieldId, limits] of Object.entries(fieldLimits)) {
    const field = document.getElementById(fieldId);
    if (field) {
      field.setAttribute('data-min', limits.min);
      field.setAttribute('data-max', limits.max);
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  applyFieldLimits();
  FormValidator.init();
});

window.currentStep = 0;
const hasCoBorrower = true; 
const stepsWithCoBorrower = ["step1", "step2", "step3", "step4"];
const stepsWithoutCoBorrower = ["step1", "step2", "step3"];
