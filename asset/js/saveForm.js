document.addEventListener("DOMContentLoaded", function () {
    const saveButton = document.querySelector('#save');
    if (saveButton) {
        saveButton.addEventListener('click', function (event) {
            event.preventDefault();
            saveFormData();
        });
    }

    const uuid = new URLSearchParams(window.location.search).get('uuid');
    if (uuid) {
        fetchFormData(uuid);
    }

    function fetchFormData(uuid) {
        const baseUrl = `${window.location.protocol}//${window.location.host}`;
        const apiPath = `/index.php?action=loadFormData&uuid=${uuid}`;
        const url = baseUrl + apiPath;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok. Status: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    fillForm(data.savedData);
                    navigateToSavedStep(data.savedData);
                } else {
                    console.error('Erreur lors du chargement des données:', data.message);
                }
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des données:', error);
            });
    }

    function fillForm(formData) {
        for (const key in formData) {
            if (formData.hasOwnProperty(key)) {
                const elements = document.querySelectorAll(`[name="${key}"]`);
                elements.forEach(element => {
                    if (element.type === 'radio' || element.type === 'checkbox') {
                        if (element.value === formData[key]) {
                            element.checked = true;
                        }
                    } else if (element.tagName === 'SELECT') {
                        const option = element.querySelector(`option[value="${formData[key]}"]`);
                        if (option) {
                            option.selected = true;
                        }
                    } else {
                        element.value = formData[key];
                    }
                });
            }
        }
    }

    function navigateToSavedStep(formData) {
        if (formData.currentStep !== undefined) {
            window.currentStep = formData.currentStep;
            showCurrentStep();
        }
    }

    function collectFormData() {
        const emailInput = document.querySelector('#emailSave');
        if (!emailInput || !emailInput.value || !/\S+@\S+\.\S+/.test(emailInput.value)) {
            console.error('Invalid email input');
            return null;
        }

        const uuid = localStorage.getItem('formUuid') || '';
        const currentStep = window.currentStep;
        const dataToSave = {
            emailSave: emailInput.value,
            uuid: uuid,
            currentStep: currentStep
        };

        document.querySelectorAll('#myForm input, #myForm select, #myForm textarea').forEach(element => {
            if (element.name) {
                if (element.type === 'radio' || element.type === 'checkbox') {
                    if (element.checked) {
                        dataToSave[element.name] = element.value;
                    }
                } else {
                    if (element.value.trim() !== '') {
                        dataToSave[element.name] = element.value;
                    }
                }
            }
        });

        return JSON.stringify(dataToSave);
    }

    function saveFormData() {
        const jsonData = collectFormData();
        if (!jsonData) {
            console.error('Invalid email input');
            return;
        }

        const baseUrl = `${window.location.protocol}//${window.location.host}`;
        const apiPath = '/index.php?action=saveFormData';
        const url = baseUrl + apiPath;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: jsonData
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.success) {
                localStorage.setItem('formUuid', data.uuid);
                alert('Données sauvegardées avec succès.');
            } else {
                console.error('Erreur lors de la sauvegarde des données:', data.message);
            }
        })
        .catch(error => console.error('Erreur:', error));
    }

    // Fonction pour masquer toutes les étapes du formulaire
    function hideAllSteps() {
        document.querySelectorAll('.form-container .step').forEach(step => step.style.display = 'none');
    }

    // Fonction pour afficher l'étape courante du formulaire
    function showCurrentStep() {
        hideAllSteps();
        const steps = document.querySelectorAll('.form-container .step');
        if (steps[window.currentStep]) {
            steps[window.currentStep].style.display = 'block';
        }
        updateActiveStep();
    }

    // Initialisation de l'étape courante
    window.currentStep = 0;
    showCurrentStep();

    // Fonctions pour naviguer entre les étapes
    document.querySelectorAll('.btnPrev, .btnNext').forEach(button => {
        button.addEventListener('click', function() {
            const stepDelta = this.classList.contains('btnNext') ? 1 : -1;
            window.currentStep += stepDelta;
            showCurrentStep();
        });
    });

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
});
