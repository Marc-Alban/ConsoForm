<div class="container text-center situation_pro tab step" id="4-content">
    <div data-category="Situation patrimoniale"></div>
    <div class="row" id="btnPlacement">
        <div class="title">
            <h2 class="text-primary offset-md-4 col-md-4 text-center">
                MA SITUATION PATRIMONIALE
            </h2>
        </div>
        <div data-category="Statut patrimonial"></div>
        <div class="step1_1A_project col-12">
            <div class="row justify-content-center">
                <!-- Propriétaire -->
                <div class="col-12 col-md-4 d-grid gap-2">
                    <input class="btnRadioStart btnRadio-1 invisible" type="radio" id="proprietaire" name="logement" value="proprietaire" data-type="radio">
                    <label for="proprietaire" id="labelProprietaire" class="btn-form">Propriétaire</label>
                </div>
                <!-- Locataire -->
                <div class="col-12 col-md-4 d-grid gap-2">
                    <input class="btnRadioStart btnRadio-2 invisible" type="radio" id="locataire" name="logement" value="locataire" data-type="radio">
                    <label for="locataire" id="labelLocataire" class="btn-form">Locataire</label>
                </div>
                <!-- Hébergé -->
                <div class="col-12 col-md-4 d-grid gap-2">
                    <input class="btnRadioStart btnRadio-3 invisible" type="radio" id="heberge" name="logement" value="heberge" data-type="radio">
                    <label for="heberge" id="labelHeberge" class="btn-form">Hébergé</label>
                </div>
            </div>

            <div class="col-12 error-container d-none text-start mt-3" id="error-logement">
                <p>Veuillez choisir un de ces champs</p>
            </div>
            <!-- Date d'occupation du logement -->
            <div class="row justify-content-center custom-margin mt-4 d-none" id="occupationField">
                <label for="dateOccupation" class="col-12 col-md-4 fw-bold text-start">J'occupe mon logement depuis :</label>
                <div class="col-12 col-md-4">
                    <input class="form-input text-center" type="number" inputmode="numeric" pattern="[0-9]*" min="1900" max="2100" step="1" placeholder="Ex : 2021" name="dateOccupation" id="dateOccupation" data-type="dateFour">
                    <div class="col-12 error-container d-none text-start mt-3" id="error-dateOccupation">
                        <p>Veuillez renseigner l'année d'occupation (ex : 2021)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="btnForm btn-form-situationpatrimoine mt-5">
        <div class="row justify-content-center justify-content-md-end">
            <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
            <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>