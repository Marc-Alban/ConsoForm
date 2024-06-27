<div class="container text-center situation_pro tab step" id="3-content">
    <div data-category="Credit"></div>
    <div class="title">
        <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4 text-center">
            MON CRÉDIT
        </h2>
    </div>
    <div class="step1_1A_project col-12">
        <div class="row justify-content-center">
            <!-- Montant souhaité -->
            <label for="montantSouhaite" class="col-12 col-md-4 fw-bold text-start">Montant souhaité : <br> <small class="smallLabel">(À partir de 200€)</small> </label>
            <div class="select2-selection--single col-12 col-md-8">
                <div class="input-group">
                    <input type="number" inputmode="numeric" pattern="[0-9]*" id="montantSouhaite" name="montantSouhaite" class="form-control input-number form-input col-12" placeholder="Ex : 12 000" data-type="integer">
                    <span class="input-group-text">€</span>
                </div>
                <div class="col-12 error-container d-none text-start mt-3" id="error-montantSouhaite">
                    <p>Veuillez mettre un chiffre entre 0 et 1 millions</p>
                </div>
            </div>

            <!-- Durée de remboursement souhaitée -->
            <label for="dureeRemboursement" class="col-12 col-md-4 fw-bold text-start mt-4">Durée de remboursement souhaitée <br> <small class="smallLabel">(jusqu'à 12 ans)</small> :</label>
            <div class="select2-selection--single col-12 col-md-8 mt-4">
                <div class="input-group">
                    <input type="number" inputmode="numeric" pattern="[0-9]*" id="dureeRemboursement" name="dureeRemboursement" class="form-control form-input col-12" placeholder="Ex : 8" data-type="dateTwo">
                    <span class="input-group-text">ans</span>
                </div>
                <div class="col-12 error-container d-none text-start mt-3" id="error-dureeRemboursement">
                    <p>Veuillez mettre un nombre d'année entre 1 an et 12 ans</p>
                </div>
            </div>

            <!-- Obtenir les fonds -->
            <label for="obtenirFonds" class="col-12 col-md-4 fw-bold text-start mt-4">Je souhaite obtenir les fonds :</label>
            <div class="select2-selection--single col-12 col-md-8 mt-4">
                <select id="obtenirFonds" name="obtenirFonds" class="form-select situationfamiliale form-input col-12" data-type="select">
                    <option value="" selected>Sélectionner</option>
                    <option value="immediatement">Immédiatement</option>
                    <option value="delai_un_mois">Dans un délai d'un mois</option>
                    <option value="delai_superieur_un_mois">Dans un délai supérieur à un mois</option>
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-obtenirFonds">
                    <p>Veuillez choisir parmi les champs proposés</p>
                </div>
            </div>

            <!-- Option assurance de prêt -->
            <label for="assurancePret" class="col-12 col-md-4 fw-bold text-start mt-4">Mon option assurance de prêt :</label>
            <div class="select2-selection--single col-12 col-md-8 mt-4">
                <select id="assurancePret" name="assurancePret" class="form-select situationfamiliale form-input col-12" data-type="select">
                    <option value="" selected>Sélectionner</option>
                    <option value="garanties_completes">Je souscris les garanties décès, invalidité, arrêt de travail et perte d'emploi</option>
                    <option value="refuse_assurance">Je refuse l'assurance proposée</option>
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-assurancePret">
                    <p>Veuillez choisir parmi les champs proposés</p>
                </div>
            </div>
        </div>
    </div>
    <div class="btnForm btn-form-credit">
        <div class="row justify-content-center justify-content-md-end">
            <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
            <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>
