document.addEventListener('DOMContentLoaded', function() {
    // Variables globales
    window.hasCoBorrower = false;
    window.hasSelectedNon = false;
    window.currentStepOnNonSelection = null;

    window.stepsWithCoBorrower = [
        '0-content', '1-content', '2-content', '3-content', '4-content', 
        '5-content', '6-content', '7-content', '8-content', '9-content', 
        '10-content', '11-content', '12-content', '13-content', '14-content', 
        '15-content', '16-content'
    ];

    window.stepsWithoutCoBorrower = [
        '0-content', '1-content', '2-content', '3-content', '4-content', 
        '5-content', '6-content', '8-content', '10-content', 
        '11-content', '12-content', '13-content', '14-content'
    ];

    console.log("hasCoBorrower initial:", window.hasCoBorrower);

    const steps = document.querySelectorAll('.form-container .step');
    const btnOui = document.getElementById('oui');
    const btnNon = document.getElementById('non');
    const modal = new bootstrap.Modal(document.getElementById('propositionModal'));
    const btnOkModal = document.getElementById('btn-ok-modal');
    const situationFamilialeElement = document.getElementById('situationFamiliale');

    // Initialiser le validateur de formulaire
    const formValidator = new FormValidator(".form-container .step", ".btnNext", ".btnPrev", "#summary");
    console.log("Initial step:", window.currentStep);

    function initForm() {
        window.currentStep = 0;
        showCurrentStep();
    }

    function hideAllSteps() {
        steps.forEach(step => step.style.display = 'none');
    }

    function showCurrentStep() {
        console.log("showCurrentStep called");
        hideAllSteps();
        const currentStepsArray = window.hasCoBorrower ? window.stepsWithCoBorrower : window.stepsWithoutCoBorrower;
        const currentStepId = currentStepsArray[window.currentStep];
        if (currentStepId) {
            const currentStepElement = document.getElementById(currentStepId);
            if (currentStepElement) {
                currentStepElement.style.display = 'block';
            }
        }
        updateActiveStep();
    }

    function validateVisibleFields() {
        const isValid = formValidator.validateStep(window.currentStep);
        if (!isValid) {
            displayErrorsForCurrentStep();
        } else {
            clearErrorsForCurrentStep();
        }
        return isValid;
    }

    function displayErrorsForCurrentStep() {
        const step = steps[window.currentStep];
        const fields = step.querySelectorAll("input, select, textarea");

        fields.forEach(field => {
            if (!formValidator.validateField(field)) {
                field.classList.add('error-border'); 
                let errorContainer = document.getElementById(`error-${field.name}`);
                if (errorContainer && errorContainer.classList.contains('error-container')) {
                    errorContainer.style.display = 'block'; 
                }
            }
        });
    }
    
    function setStep(index) {
        const currentStepsArray = window.hasCoBorrower ? window.stepsWithCoBorrower : window.stepsWithoutCoBorrower;
        if (index < 0 || index >= currentStepsArray.length) return;
        hideAllSteps();
        document.getElementById(currentStepsArray[index]).classList.remove('d-none');
        window.currentStep = index;
        showCurrentStep();
    }

    
    function clearErrorsForCurrentStep() {
        const step = steps[window.currentStep];
        const fields = step.querySelectorAll("input, select, textarea");

        fields.forEach(field => {
            field.classList.remove('error-border'); 
            const errorContainer = document.getElementById(`error-${field.name}`);
            if (errorContainer && errorContainer.classList.contains('error-container')) {
                errorContainer.style.display = 'none'; 
            }
        });
    }

    function goToStep(stepDelta) {
        console.log("goToStep called with stepDelta:", stepDelta);
        if (!validateVisibleFields()) return;
        let currentStepsArray = window.hasCoBorrower ? window.stepsWithCoBorrower : window.stepsWithoutCoBorrower;
        let potentialNextStep = window.currentStep + stepDelta;

        const maxStepIndex = currentStepsArray.length - 1;
        potentialNextStep = Math.max(0, Math.min(potentialNextStep, maxStepIndex));
        if (window.currentStep !== potentialNextStep) {
            window.currentStep = potentialNextStep;
            console.log("New currentStep:", window.currentStep);
            showCurrentStep();
        }
    }

    function updateActiveStep() {
        const isMobile = window.innerWidth <= 991;
        const currentStepsArray = window.hasCoBorrower ? window.stepsWithCoBorrower : window.stepsWithoutCoBorrower;
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

    if (btnNon) {
        btnNon.addEventListener('change', function() {
            window.hasSelectedNon = btnNon.checked;
            window.currentStepOnNonSelection = window.currentStep;
            console.log("btnNon changed, setStep to 13");
            setStep(13);
        });
    }

    if (btnOui) {
        btnOui.addEventListener('change', function() {
            window.hasSelectedNon = false;
            window.currentStepOnNonSelection = window.currentStep;
            console.log("btnOui changed, setStep to 12");
            setStep(12);
        });
    }

    document.querySelectorAll('.btnPrev, .btnNext').forEach(function(button) {
        button.addEventListener('click', function() {
            const stepDelta = this.classList.contains('btnNext') ? 1 : -1;
            goToStep(stepDelta);
        });
    });

    window.currentStep = 0;
    showCurrentStep();

    initForm();
    window.setStep = setStep;
    window.goToStep = goToStep;

    if (btnOkModal) {
        btnOkModal.addEventListener('click', function() {
            modal.hide();
        });
    }

    const radioButtons = document.querySelectorAll('.hidden-input');
    const labelsProjet = document.querySelectorAll('.projet-label');
    const labelsNature = document.querySelectorAll('.nature-label');
    const btnNextProjet = document.querySelector('#btnNextProjet');
    const btnNextNature = document.querySelector('#btnNextNature');
    const btnPrev = document.querySelector('#btnPrev');
    const errorContainerProjet = document.getElementById('error-projet');
    const errorContainerNature = document.getElementById('error-travaux');

    function checkSelectionProjet() {
        const isActiveProjet = Array.from(labelsProjet).some(l => l.classList.contains('active'));
        if (btnNextProjet) btnNextProjet.disabled = !isActiveProjet;
    }

    function checkSelectionNature() {
        const isActiveNature = Array.from(labelsNature).some(l => l.classList.contains('active'));
        if (btnNextNature) btnNextNature.disabled = !isActiveNature;
    }

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

            goToStep(1);
        });
    });

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

    if (situationFamilialeElement) {
        situationFamilialeElement.addEventListener('change', function() {
            const selectedValue = this.value;
            window.hasCoBorrower = selectedValue === 'marie' || selectedValue === 'pacse' || selectedValue === 'union';
            console.log("hasCoBorrower changed:", window.hasCoBorrower);
        });
    }

    initForm();
    showCurrentStep();
});
