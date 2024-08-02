<div class="container final-container text-center situation_pro tab step" id="16-content">
    <div data-category="Coordonnées"></div>
    <div class="row" id="creditRac">
        <!-- auto -->
        <div class="title">
            <h2 class="text-primary offset-md-3 col-md-6 text-center">
                MES COORDONNÉES
            </h2>
        </div>
        <div class="step1_1A_project col-12">
            <div class="row">
                <!-- Mes coordonnées -->
                <div class="container-div-text">
                    <!-- Adresse -->
                    <div class="row mb-3">
                        <label for="adresse1" class="col-12 col-md-3 fw-bold text-start">Adresse :</label>
                        <div class="col-12 col-md-9">
                            <input type="text" id="adresse1" name="adresse1" class="form-input col-12" placeholder='Ex : 5 rue de Victoire' data-type="string" required>
                            <div class="col-12 error-container text-start mt-3" style="display:none" id="error-adresse1">
                                <p>Veuillez remplir ce champs</p>
                            </div>
                        </div>
                    </div>
                    <!-- Code Postal et Ville -->
                    <div class="row mb-3">
                        <label for="codePostal" class="col-12 col-md-3 fw-bold text-start">Code postal :</label>
                        <div class="col-12 col-md-3">
                            <input type="text" inputmode="numeric" pattern="[0-9]*" id="codePostal" name="codePostal" class="form-input col-12" placeholder='Ex : 75001' data-type="integer" required>
                            <div class="col-12 error-container text-start mt-3" style="display:none" id="error-codePostal">
                                <p>Veuillez remplir ce champs</p>
                            </div>
                        </div>
                        <label for="ville" class="col-12 col-md-2 fw-bold text-start">Ville :</label>
                        <div class="col-12 col-md-4">
                            <input type="text" id="ville" name="ville" class="form-input col-12" placeholder='Ex : Paris' data-type="string" required>
                            <div class="col-12 error-container text-start mt-3" style="display:none" id="error-ville">
                                <p>Veuillez remplir ce champs</p>
                            </div>
                            <!-- Liste des résultats pour l'auto-complétion -->
                            <ul id="resultsList"></ul>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="row mb-3">
                        <label for="telephone" class="col-12 col-md-3 fw-bold text-start">Téléphone :</label>
                        <div class="col-12 col-md-9">
                            <input type="tel" id="telephone" name="telephone" class="form-input input-tel col-12" placeholder='Ex : 06 12 34 45 67' data-type="phone" required>
                            <div class="col-12 error-container text-start mt-3" style="display:none" id="error-telephone">
                                <p>Veuillez remplir ce champs</p>
                            </div>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="row mb-3">
                        <label for="email" class="col-12 col-md-3 fw-bold text-start">Email :</label>
                        <div class="col-12 col-md-9">
                            <input type="email" id="email" name="email" class="form-input input-email col-12" placeholder='Ex : olivier123@gmail.com' data-type="mail" required>
                            <div class="col-12 error-container text-start mt-3" style="display:none" id="error-email">
                                <p>Veuillez mettre un email valide</p>
                            </div>
                        </div>
                    </div>
                    <!-- Accepter CGV -->
                    <div class="row mb-3">
                        <div class="col-12 col-md-3 fw-bold text-start"></div>
                        <div class="col-12 col-md-9">
                            <div class="form-check text-start">
                                <input type="checkbox" id="cgv" name="cgv" class="form-check-input" data-type="checkbox">
                                <label class="form-check-label condtion-label col-11 cgv-text" for="cgv" required>
                                    J'accepte que les informations transmises soient utilisées par Solutis et ses partenaires dans le cadre d'une demande de financement et de la relation commerciale qui peut en découler *
                                </label>
                                <div class="col-12 error-container text-start mt-3" style="display:none" id="error-cgv">
                                    <p>Veuillez cocher cette case</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Souhaitez-vous être recontacté -->
                    <div class="row mb-12">
                        <label class="col-12 col-md-12 fw-bold text-start">Souhaitez-vous être recontacté pour renégocier vos contrats ?</label>
                        <div class="col-12 col-md-9 mt-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between align-content-center">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="energie" value="energie">
                                    <label class="form-check-label label-check" for="energie">Énergie</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assurance_auto" value="assurance_auto">
                                    <label class="form-check-label label-check" for="assurance_auto">Assurance auto</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="assurance_habitation" value="assurance_habitation">
                                    <label class="form-check-label label-check" for="assurance_habitation">Assurance habitation</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="internet" value="internet">
                                    <label class="form-check-label label-check" for="internet">Internet et téléphone</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="mutuelle" value="mutuelle">
                                    <label class="form-check-label label-check" for="mutuelle">Mutuelle</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin de la section Mes coordonnées -->
            </div>
        </div>
    </div>
    <!-- fin auto -->
    <div class="btnForm mt-5">
        <div class="row justify-content-center justify-content-md-end">
            <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
            <button id="submit-button" data-step="end" class="btn btn-primary btnNext btnEnd">VALIDER<i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>
<script>
    document.getElementById('submit-button').disabled = true;

    const submitButton = document.getElementById('submit-button');

    if (submitButton) {
        submitButton.addEventListener('click', function(event) {
            handleFormSubmission(event);
        });
    }

    function handleFormSubmission(event) {
        event.preventDefault();
        if (validateAllSteps()) {
            // Code pour soumettre le formulaire
        } else {
            submitButton.disabled = false;
        }
    }

    function validateAllSteps() {
        let isValid = true;
        const fieldsToCheck = [{
                id: 'adresse1',
                errorId: 'error-adresse1'
            },
            {
                id: 'codePostal',
                errorId: 'error-codePostal'
            },
            {
                id: 'ville',
                errorId: 'error-ville'
            },
            {
                id: 'telephone',
                errorId: 'error-telephone'
            },
            {
                id: 'email',
                errorId: 'error-email'
            },
            {
                id: 'cgv',
                errorId: 'error-cgv',
                isCheckbox: true
            }
        ];

        fieldsToCheck.forEach(field => {
            const input = document.getElementById(field.id);
            const errorDiv = document.getElementById(field.errorId);
            if (field.isCheckbox) {
                if (!input.checked) {
                    isValid = false;
                    errorDiv.classList.remove('d-none');
                } else {
                    errorDiv.classList.add('d-none');
                }
            } else {
                if (!input.value.trim()) {
                    isValid = false;
                    errorDiv.classList.remove('d-none');
                } else {
                    errorDiv.classList.add('d-none');
                }
            }
        });

        return isValid;
    }

    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('change', function() {
            submitButton.disabled = !validateAllSteps();
        });
    });
</script>