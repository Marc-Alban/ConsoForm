document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('#save').addEventListener('click', function (event) {
        event.preventDefault();

        const emailInput = document.querySelector('#emailSave');
        if (!emailInput || !emailInput.value || !/\S+@\S+\.\S+/.test(emailInput.value)) {
            return;
        }

        const uuid = localStorage.getItem('formUuid') || '';
        var currentStep = window.currentStep;
        const container = document.getElementById(currentStep + '-content');
     

        var currentCategory = ''


                if (container) {
                    const elementsWithDataCategory = container.querySelectorAll('[data-category]');

                    elementsWithDataCategory.forEach(element => {
                        currentCategory = element.getAttribute('data-category');                        
                    });
                }


                var index_categorie_actuelle = 0;

                if(currentCategory == "Credit"){
                    index_categorie_actuelle = 1;
                }
                else if(currentCategory == "Situation patrimoniale"){
                    index_categorie_actuelle = 2;
                }
                else if(currentCategory == "Situation familiale"){
                    index_categorie_actuelle = 3;
                }
                else if(currentCategory == "Situation professionnelle"){
                    index_categorie_actuelle = 4;
                }
                else if(currentCategory == "Situation professionnelle du co-emprunteur"){
                    index_categorie_actuelle = 5;
                }
                else if(currentCategory == "Situation financière du foyer"){
                    index_categorie_actuelle = 6;
                }
                else if(currentCategory == "Coordonnées"){
                    index_categorie_actuelle = 7;
                }
 
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



        const jsonData = JSON.stringify(dataToSave);
       // console.log('Données à sauvegarder:', jsonData);

        const baseUrl = `${window.location.protocol}//${window.location.host}`;
        const apiPath = '/rac/index.php?action=saveFormData';
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
                    // Ferme l'ancienne modale
                    $('#ModalSave').modal('hide');

                    // Ouvre la modale de confirmation
                    $('#successModal').modal('show');
                    
                } else {
                    console.error('Erreur lors de la sauvegarde des données:', data.message);
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
});

function isElementVisible(element) {
    return element.offsetWidth > 0 && element.offsetHeight > 0;
}
