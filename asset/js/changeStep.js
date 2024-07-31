document.addEventListener('DOMContentLoaded', function() {
  // Sélection des éléments du formulaire
   // Initialisation des éléments du formulaire et des variables
   const steps = document.querySelectorAll('.form-container .step');
   const stepsArray = Array.from(steps);
   const btnOui = document.getElementById('oui');
   const btnNon = document.getElementById('non');
   const modal = new bootstrap.Modal(document.getElementById('propositionModal'));
   const btnOkModal = document.getElementById('btn-ok-modal');
   const formValidator = new FormValidator(".form-container .step", ".btnNext", ".btnPrev", "#summary");
   const situationFamilialeElement = document.getElementById('situationFamiliale');
 
   // Correction de l'ordre des étapes pour le co-emprunteur
   const stepsWithCoBorrower = [
     '0-content', '1-content', '2-content', '3-content', '4-content', 
     '5-content', '6-content', '7-content', '8-content', '9-content', 
     '10-content', '11-content', '12-content', '13-content', '14-content', 
     '15-content', '16-content'
   ];
 
   // Tableau des étapes sans co-emprunteur
   const stepsWithoutCoBorrower = [
     '0-content', '1-content', '2-content', '3-content', '4-content', 
     '5-content', '6-content', '8-content', '10-content', 
     '11-content', '12-content', '13-content', '14-content'
   ];
 

   // Variables pour gérer l'état du formulaire
   let hasCoBorrower = false;
   let hasSelectedNon = false;
   let currentStepOnNonSelection = null;
 
   // Fonction pour initialiser le formulaire
   function initForm() {
     window.currentStep = 0; // Réinitialiser à l'étape zéro
     showCurrentStep();
   }

  // Fonctions de gestion du formulaire
  function hideAllSteps() {
    steps.forEach(step => step.style.display = 'none');
  }

  function showCurrentStep() {
    hideAllSteps();
    const currentStepsArray = hasCoBorrower ? stepsWithCoBorrower : stepsWithoutCoBorrower;
    if (stepsArray[window.currentStep]) {
      document.getElementById(currentStepsArray[window.currentStep]).style.display = 'block';
    }
    updateActiveStep();
  }

  // Fonction pour valider les champs visibles de l'étape courante
  function validateVisibleFields() {
    const isValid = formValidator.validateStep(window.currentStep);
    if (!isValid) {
      alert('Veuillez corriger les erreurs avant de continuer.');
    }
    return isValid;
  }

  function goToStep(stepDelta) {
    if (!validateVisibleFields()) return;
    let currentStepsArray = hasCoBorrower ? stepsWithCoBorrower : stepsWithoutCoBorrower;
    let potentialNextStep = window.currentStep + stepDelta;
    const maxStepIndex = currentStepsArray.length - 1;
    potentialNextStep = Math.max(0, Math.min(potentialNextStep, maxStepIndex));
    if (window.currentStep !== potentialNextStep) {
      window.currentStep = potentialNextStep;
      showCurrentStep();
    }
  }

  // Fonction pour définir une étape spécifique comme étape courante
  function setStep(index) {
    let currentStepsArray = hasCoBorrower ? stepsWithCoBorrower : stepsWithoutCoBorrower;
    if (index < 0 || index >= currentStepsArray.length) return;
    hideAllSteps();
    document.getElementById(currentStepsArray[index]).style.display = 'block';
    window.currentStep = index;
    showCurrentStep();
  }

  // Mise à jour de l'indicateur d'étape actif selon la catégorie
  function updateActiveStep() {
    const isMobile = window.innerWidth <= 991;
    const currentStepsArray = hasCoBorrower ? stepsWithCoBorrower : stepsWithoutCoBorrower;
    const currentFormStep = document.getElementById(currentStepsArray[window.currentStep]);
    const currentCategory = currentFormStep ? currentFormStep.querySelector('[data-category]')?.getAttribute('data-category') : null;
    const progressSteps = document.querySelectorAll('.form-sidebar .sidebar .step');

    progressSteps.forEach(function(step) {
      const bar = step.nextElementSibling;
      const stepContent = step.querySelector('.step-content');
      if (!stepContent) {
        console.error("Élément '.step-content' introuvable dans l'étape.");
        return;
      }

      if (!isMobile) {
        stepContent.style.display = 'block';
        if (step.getAttribute('data-category') === currentCategory) {
          step.classList.add('active');
          if (bar) {
            bar.style.backgroundColor = '#bff574';
          }
        }
      } else {
        if (step.getAttribute('data-category') === currentCategory) {
          step.classList.add('active');
          stepContent.style.display = 'block';
          if (bar) {
            bar.style.backgroundColor = '#bff574';
          }
          const stepContentP = stepContent.querySelector('p');
          if (stepContentP) {
            stepContentP.style.display = 'block';
          }
        } else {
          stepContent.style.display = 'none';
          const stepContentP = stepContent.querySelector('p');
          if (stepContentP) {
            stepContentP.style.display = 'none';
          }
        }
      }
    });
  }

  // Event Listeners pour les boutons et autres éléments interactifs
  if (btnNon) {
    btnNon.addEventListener('change', function() {
      hasSelectedNon = btnNon.checked;
      currentStepOnNonSelection = window.currentStep;
      setStep(13); // Spécifique pour 'Non'
    });
  }

  if (btnOui) {
    btnOui.addEventListener('change', function() {
      hasSelectedNon = false;
      currentStepOnNonSelection = window.currentStep;
      setStep(12); // Spécifique pour 'Oui'
    });
  }

  // Boutons pour naviguer précédemment ou suivant et mise à jour de l'étape
  document.querySelectorAll('.btnPrev, .btnNext').forEach(function(button) {
    button.addEventListener('click', function() {
      const stepDelta = this.classList.contains('btnNext') ? 1 : -1;
      goToStep(stepDelta);
    });
  });

  // Montre l'étape initiale au chargement
  window.currentStep = 0;
  showCurrentStep();

  // Fonctions globales pour définir une étape ou naviguer vers une étape
  initForm();
  window.setStep = setStep;
  window.goToStep = goToStep;
  
  // Gestion du bouton OK dans le modal
  if (btnOkModal) {
    btnOkModal.addEventListener('click', function() {
      modal.hide();
    });
  }

  // Divers éléments interactifs et gestion des sélections dans le formulaire
  const radioButtons = document.querySelectorAll('.hidden-input');
  const labelsProjet = document.querySelectorAll('.projet-label');
  const labelsNature = document.querySelectorAll('.nature-label');
  const btnNextProjet = document.querySelector('#btnNextProjet');
  const btnNextNature = document.querySelector('#btnNextNature');
  const btnPrev = document.querySelector('#btnPrev');
  const errorContainerProjet = document.getElementById('error-projet');
  const errorContainerNature = document.getElementById('error-travaux');

  // Vérification de la sélection pour activer le bouton suivant
  function checkSelectionProjet() {
    const isActiveProjet = Array.from(labelsProjet).some(l => l.classList.contains('active'));
    if (btnNextProjet) btnNextProjet.disabled = !isActiveProjet;
  }

  function checkSelectionNature() {
    const isActiveNature = Array.from(labelsNature).some(l => l.classList.contains('active'));
    if (btnNextNature) btnNextNature.disabled = !isActiveNature;
  }

  // Réinitialisation des sélections lors de la navigation arrière
  function resetSelections() {
    radioButtons.forEach(radio => {
      radio.checked = false;
    });

    labelsProjet.forEach(label => {
      label.classList.remove('active');
      label.style.borderColor = '';
    });

    labelsNature.forEach(label => {
      label.classList.remove('active');
      label.style.borderColor = '';
    });
  }

  // Gestion des événements de changement pour les boutons radio
  radioButtons.forEach(radio => {
    radio.addEventListener('change', function() {
      resetSelections();

      labelsProjet.forEach(label => {
        if (label.getAttribute('for') === this.id) {
          label.classList.add('active');
          label.style.borderColor = 'red';
        }
      });

      labelsNature.forEach(label => {
        if (label.getAttribute('for') === this.id) {
          label.classList.add('active');
          label.style.borderColor = 'red';
        }
      });

      checkSelectionProjet();
      checkSelectionNature();

      goToStep(1);  // Navigue à l'étape suivante après la sélection
    });
  });

  // Gestion des boutons suivants et précédents, avec vérification de l'activité pour naviguer
  if (btnNextProjet) {
    btnNextProjet.addEventListener('click', function(e) {
      const isActive = Array.from(labelsProjet).some(l => l.classList.contains('active'));
      if (!isActive) {
        e.preventDefault();
        errorContainerProjet.classList.remove('d-none');
      } else {
        errorContainerProjet.classList.add('d-none');
        btnNextProjet.style.borderColor = '';
        goToStep(1);
      }
    });
  }

  if (btnNextNature) {
    btnNextNature.addEventListener('click', function(e) {
      const isActive = Array.from(labelsNature).some(l => l.classList.contains('active'));
      if (!isActive) {
        e.preventDefault();
        errorContainerNature.classList.remove('d-none');
      } else {
        errorContainerNature.classList.add('d-none');
        btnNextNature.style.borderColor = '';
        goToStep(1);
      }
    });
  }

  if (btnPrev) {
    btnPrev.addEventListener('click', function() {
      resetSelections();
      goToStep(-1);
    });
  }

  // Gestion de l'élément de situation familiale pour déterminer la présence d'un co-emprunteur
  if (situationFamilialeElement) {
    situationFamilialeElement.addEventListener('change', function() {
      const selectedValue = this.value;
      hasCoBorrower = selectedValue === 'marie' || selectedValue === 'pacse' || selectedValue === 'union';
      window.currentStep = 0;  // Reinitialiser l'étape courante lors du changement de la situation familiale
      showCurrentStep();
    });
  }

  // Initialise l'étape courante et montre l'étape correspondante
  window.currentStep = 0;
  showCurrentStep();
});