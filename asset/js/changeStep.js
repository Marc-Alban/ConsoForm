document.addEventListener('DOMContentLoaded', function() {
    // 1. Déclarations des variables
    const steps = document.querySelectorAll('.form-container .step');
    const stepsArray = Array.from(steps);
    const situationFamilialeSelect = document.querySelector('.situationfamiliale');
    const btnOui = document.getElementById('oui');
    const btnNon = document.getElementById('non');
    const modal = new bootstrap.Modal(document.getElementById('propositionModal'));
    const btnOkModal = document.getElementById('btn-ok-modal');
    const formValidator = new FormValidator(".form-container .step", ".btnNext");

    let hasCoBorrower = false;
    let hasSelectedNon = false;
    let currentStepOnNonSelection = null;

    // 2. Fonctions Utilitaires

    // Affiche une modale d'avertissement
    function showModal() {
        const modal = document.getElementById('warning-modal');
        if (modal) {
            const myModal = new bootstrap.Modal(modal);
            myModal.show();
        }
    }

    // Cache toutes les étapes
    function hideAllSteps() {
        steps.forEach(step => step.style.display = 'none');
    }

    // Affiche l'étape actuelle
    function showCurrentStep() {
        hideAllSteps();
        if (stepsArray[window.currentStep]) {
            stepsArray[window.currentStep].style.display = 'block';
        }
    }

    // Valide les champs visibles
    function validateVisibleFields() {
        return formValidator.validateStep(window.currentStep);
    }

    // Navigation vers une étape spécifique
    function goToStep(stepDelta) {
        if (!validateVisibleFields()) {
            showModal();
            return;
        }

        let potentialNextStep = window.currentStep + stepDelta;
        const maxStepIndex = stepsArray.length - 1;

        // Si pas de co-emprunteur, ignorer les sous-étapes de co-emprunteur
        if (stepDelta > 0 && !hasCoBorrower) {
            while (potentialNextStep <= maxStepIndex && stepsArray[potentialNextStep].classList.contains('subStepCoBorrower')) {
                potentialNextStep++;
            }
        }

        if (stepDelta < 0 && !hasCoBorrower) {
            while (potentialNextStep >= 0 && stepsArray[potentialNextStep].classList.contains('subStepCoBorrower')) {
                potentialNextStep--;
            }
        }

        // S'assurer que l'étape reste dans les limites
        if (potentialNextStep < 0) potentialNextStep = 0;
        if (potentialNextStep > maxStepIndex) potentialNextStep = maxStepIndex;

        if (window.currentStep !== potentialNextStep) {
            window.currentStep = potentialNextStep;
            showCurrentStep();
        }
    }

    // Définir une étape spécifique
    function setStep(index) {
        if (index < 0 || index >= stepsArray.length) return;
        hideAllSteps();
        stepsArray[index].style.display = 'block';
        window.currentStep = index;
    }

    // Met à jour le scénario de co-emprunteur
    function updateActiveStep() {
        const isMobile = window.innerWidth <= 991;
        const currentFormStep = Array.from(document.querySelectorAll('.container.text-center.tab.step')).find(el => {
            return el.style.display !== 'none' && getComputedStyle(el).display !== 'none';
        });
        const currentCategory = currentFormStep ? currentFormStep.querySelector('[data-category]')?.getAttribute('data-category') : null;
        const progressSteps = document.querySelectorAll('.form-sidebar .sidebar .step');

        progressSteps.forEach(function (step) {
            const bar = step.nextElementSibling;
            const stepContent = step.querySelector('.step-content');
            if (!stepContent) {
                console.error("Élément '.step-content' introuvable dans la étape.");
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

    function goToStepByClick() {
        document.querySelectorAll('.form-sidebar .sidebar .step').forEach(function (stepElement) {
            stepElement.addEventListener('click', function () {
                if (this.classList.contains('non-clickable')) {
                    console.log("Cette catégorie est non cliquable.");
                    return;
                }

                const category = stepElement.getAttribute('data-category');
                const targetIndex = findStepIndexByCategory(category);

                if (stepElement.classList.contains('active') || targetIndex <= window.currentStep) {
                    navigateToCategory(category);
                } else {
                    console.warn("Vous ne pouvez pas naviguer vers cette étape avant de compléter les étapes précédentes.");
                }
            });
        });
    }

    function findStepIndexByCategory(category) {
        const allSteps = document.querySelectorAll('.container.text-center.tab.step');
        for (let i = 0; i < allSteps.length; i++) {
            const categoryDiv = allSteps[i].querySelector('[data-category]');
            if (categoryDiv && categoryDiv.getAttribute('data-category') === category) {
                return i;
            }
        }
        return -1;
    }

    function navigateToCategory(category) {
        const allSteps = document.querySelectorAll('.container.text-center.tab.step');
        let found = false;
        const currentStepCategory = allSteps[window.currentStep]?.querySelector('[data-category]')?.getAttribute('data-category');

        if (category === currentStepCategory) {
            return;
        }

        for (let step of allSteps) {
            const categoryDiv = step.querySelector('[data-category]');
            if (categoryDiv && categoryDiv.getAttribute('data-category') === category) {
                if (!found) {
                    step.style.display = 'block';
                    window.currentStep = Array.from(allSteps).indexOf(step);
                    found = true;
                } else {
                    step.style.display = 'none';
                }
            } else {
                step.style.display = 'none';
            }
        }

        if (!found) {
            console.error("Catégorie non trouvée:", category);
        }

        updateActiveStep();
    }

    // 3. Validation du Formulaire
    if (btnNon) {
        btnNon.addEventListener('change', function() {
            if (btnNon.checked) {
                hasSelectedNon = true;
                currentStepOnNonSelection = window.currentStep; 
                window.setStep(13);
            }
        });
    }

    if (btnOui) {
        btnOui.addEventListener('change', function() {
            if (btnOui.checked) {
                hasSelectedNon = false;
                currentStepOnNonSelection = window.currentStep; 
                window.setStep(12);
            }
        });
    }

    // 4. Navigation entre les étapes
    document.querySelectorAll('.btnPrev, .btnNext').forEach(function(button) {
        button.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            const stepDelta = this.classList.contains('btnNext') ? 1 : -1;
            goToStep(stepDelta);
        });
    });

    showCurrentStep();

    // 5. Gestion des Co-emprunteurs
    window.setStep = setStep;

    // 6. Gestion des Modales
    const btnOk = document.getElementById('btn-ok');
    if (btnOk) {
        btnOk.addEventListener('click', function() {
            $('#warning-modal').modal('hide');
            $('.modal-backdrop').remove();
            $('body').css('overflow', ''); 
        });
    }

    if (btnOkModal) {
        btnOkModal.addEventListener('click', function() {
            modal.hide();
        });
    }

    // 8. Sélection des Boutons de Navigation

    const radioButtons = document.querySelectorAll('.hidden-input');
    const labelsProjet = document.querySelectorAll('.projet-label');
    const labelsNature = document.querySelectorAll('.nature-label');
    const btnNextProjet = document.querySelector('#btnNextProjet');
    const btnNextNature = document.querySelector('#btnNextNature');
    const btnPrev = document.querySelector('#btnPrev');
    const errorContainerProjet = document.getElementById('error-projet');
    const errorContainerNature = document.getElementById('error-travaux');

    // Vérifie la sélection des projets
    function checkSelectionProjet() {
        const isActiveProjet = Array.from(labelsProjet).some(l => l.classList.contains('active'));
        if (btnNextProjet) btnNextProjet.disabled = !isActiveProjet;
    }

    // Vérifie la sélection de la nature des travaux
    function checkSelectionNature() {
        const isActiveNature = Array.from(labelsNature).some(l => l.classList.contains('active'));
        if (btnNextNature) btnNextNature.disabled = !isActiveNature;
    }

    // Réinitialise les sélections
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

            // Passer à l'étape suivante
            goToStep(1);
        });
    });

    // Désactiver les boutons "Suivant" par défaut
    if (btnNextProjet) btnNextProjet.disabled = true;
    if (btnNextNature) btnNextNature.disabled = true;

    // Événements de clic pour les boutons "Suivant"
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

    // Événement de clic pour le bouton "Précédent"
    if (btnPrev) {
        btnPrev.addEventListener('click', function() {
            resetSelections();
            goToStep(-1);
        });
    }

    // Initialisation de l'étape actuelle
    window.currentStep = 0;
    showCurrentStep();

    window.goToStep = goToStep; 
});
