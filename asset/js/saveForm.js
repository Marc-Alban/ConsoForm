document.addEventListener("DOMContentLoaded", function () {
    const saveButton = document.querySelector('#save');
    const uuid = new URLSearchParams(window.location.search).get('uuid');

    if (uuid) {
        fetchFormData(uuid);
    } else if (window.savedFormData) {
        fillForm(window.savedFormData);
    }

    function fetchFormData(uuid) {
        const baseUrl = `${window.location.protocol}//${window.location.host}`;
        const apiPath = `/index.php?action=loadFormData&uuid=${uuid}`;
        const url = baseUrl + apiPath;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data && data.success) {
                    console.log('Données récupérées:', data.formData); // Vérifiez que les données sont correctes
                    fillForm(data.formData);
                } else {
                    console.error('Erreur lors du chargement des données:', data.message);
                }
            })
            .catch(error => console.error('Erreur:', error));
    }

    function fillForm(formData) {
        for (const key in formData) {
            if (formData.hasOwnProperty(key)) {
                const element = document.querySelector(`[name="${key}"]`);
                if (element) {
                    if (element.type === 'radio' || element.type === 'checkbox') {
                        if (element.value === formData[key]) {
                            element.checked = true;
                        }
                    } else {
                        element.value = formData[key];
                    }
                }
            }
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
        const container = document.getElementById(currentStep + '-content');
        let currentCategory = '';

        if (container) {
            const elementsWithDataCategory = container.querySelectorAll('[data-category]');
            elementsWithDataCategory.forEach(element => {
                currentCategory = element.getAttribute('data-category');
            });
        }

        const categoryMapping = {
            "Credit": 1,
            "Situation patrimoniale": 2,
            "Situation familiale": 3,
            "Situation professionnelle": 4,
            "Situation professionnelle du co-emprunteur": 5,
            "Situation financière du foyer": 6,
            "Coordonnées": 7
        };

        const index_categorie_actuelle = categoryMapping[currentCategory] || 0;

        const dataToSave = {
            emailSave: emailInput.value,
            uuid: uuid,
            currentStep: currentStep,
            currentCategory: currentCategory,
            currentCategoryIndex: index_categorie_actuelle
        };

        document.querySelectorAll('#myForm input, #myForm select, #myForm textarea, #myForm [type="radio"], #myForm [type="checkbox"]').forEach(element => {
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
            console.log('Response from server:', data);
            if (data && data.success) {
                localStorage.setItem('formUuid', data.uuid);
                // Ferme l'ancienne modale
                $('#ModalSave').modal('hide');
                // Ouvre la modale de confirmation
                $('#successModal').modal('show');
                // Actualise la page
                window.location.reload();
            } else {
                console.error('Erreur lors de la sauvegarde des données:', data.message);
            }
        })
        .catch(error => console.error('Erreur:', error));
    }

    saveButton.addEventListener('click', function (event) {
        event.preventDefault();
        saveFormData();
    });
});