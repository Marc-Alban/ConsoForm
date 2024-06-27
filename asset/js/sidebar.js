document.addEventListener('DOMContentLoaded', function () {
    const situationFamilialeSelect = document.getElementById('situationFamiliale'); // Assurez-vous que l'élément a l'ID correct

    let hasCoBorrower = false;

    function updateSidebarForCoBorrower() {
        const steps = document.querySelectorAll('.form-sidebar .sidebar .step');
        const coBorrowerSteps = document.querySelectorAll('.form-sidebar .sidebar .step.subStepCoBorrower');
        const coBorrowerBars = document.querySelectorAll('.form-sidebar .sidebar .bar.subStepCoBorrower');

        coBorrowerSteps.forEach(step => {
            step.style.display = hasCoBorrower ? 'block' : 'none';
        });
        coBorrowerBars.forEach(bar => {
            bar.style.display = hasCoBorrower ? 'block' : 'none';
        });

        // Mise à jour des indices (data-step)
        let visibleStepIndex = 0;
        steps.forEach(step => {
            if (step.style.display !== 'none') {
                step.setAttribute('data-step', visibleStepIndex.toString());
                visibleStepIndex++;
            }
        });

        updateActiveStep();
    }

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

    situationFamilialeSelect.addEventListener('change', function () {
        hasCoBorrower = ['marie', 'pacse', 'union'].includes(this.value);
        updateSidebarForCoBorrower();
    });

    window.addEventListener('resize', function () {
        updateActiveStep();
    });

    document.querySelectorAll('.btnNext').forEach(function (button) {
        button.addEventListener('click', function () {
            setTimeout(updateActiveStep, 100);
        });
    });

    document.querySelectorAll('.btnPrev').forEach(function (button) {
        button.addEventListener('click', function () {
            const activeSteps = document.querySelectorAll('.form-sidebar .sidebar .step.active');
            if (activeSteps.length > 0) {
                const lastActiveStep = activeSteps[activeSteps.length - 1];
                lastActiveStep.classList.remove('active');
            }
            setTimeout(updateActiveStep, 1);
        });
    });

    function initializeFormState() {
        if (document.getElementById('empruntOui')?.checked) {
            hasCoBorrower = false;
        } else if (document.getElementById('empruntNon')?.checked) {
            hasCoBorrower = true;
        } else if (['marie', 'pacse', 'union'].includes(situationFamilialeSelect?.value)) {
            hasCoBorrower = true;
        } else {
            hasCoBorrower = false;
        }

        updateSidebarForCoBorrower();
    }

    initializeFormState();
    goToStepByClick();
});
