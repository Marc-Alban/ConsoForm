<div class="container text-center situation_pro tab step" id="2-content">
<div data-category="Credit"></div>

    <style>
        .custom-btn-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            padding: 20px;
            border: 2px solid #fff !important;
            border-radius: 20px;
            background-color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 100%;
            max-width: 300px;
            height: 150px;
        }

        .custom-btn-container .custom-circle {
            margin-right: 20px;
        }

        .custom-btn-container img {
            max-width: 50px;
            margin-bottom: 10px;
        }

        .custom-btn-container span {
            font-size: 16px;
            color: #000;
            font-weight: bold;
        }

        .custom-btn-container:hover,
        .custom-btn-container.active {
            color: #4738de !important;
            background-color: #ffffff !important;
            border-color: #4738de !important;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .custom-circle {
            background: #e2e6ea;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .hidden-input {
            display: none;
        }

        .grid-gap {
            margin-bottom: 20px;
        }

        .error-container {
            color: red;
            font-size: 14px;
        }
    </style>

    <div class="title">
        <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4  text-center">
            NATURE DES TRAVAUX À FINANCER
        </h2>
    </div>
    <div class="step1_1A_project col-12">
        <div class="row justify-content-center">
            <!-- Rénovation -->
            <div class="col-12 col-md-4 d-grid gap-2 grid-gap">
                <input class="hidden-input unique-radio-1" type="radio" id="renovation" name="travaux" value="renovation" data-type="radio">
                <label for="renovation" id="labelRenovation" class="custom-btn-container nature-label" data-category="Renovation">
                    <div class="custom-circle">
                        <img src="asset/img/Logos+Elements graphiques/Renovation.svg" alt="Rénovation Icon" />
                    </div>
                    <div class="label-texte">
                        <span>Rénovation</span>
                    </div>
                </label>
            </div>
            <!-- Extension -->
            <div class="col-12 col-md-4 d-grid gap-2 grid-gap">
                <input class="hidden-input unique-radio-2" type="radio" id="extension" name="travaux" value="extension" data-type="radio">
                <label for="extension" id="labelExtension" class="custom-btn-container nature-label" data-category="Extension">
                    <div class="custom-circle">
                        <img src="asset/img/Logos+Elements graphiques/Extension.svg" alt="Extension Icon" />
                    </div>
                    <div class="label-texte">
                        <span>Extension</span>
                    </div>
                </label>
            </div>
            <!-- Rénovation énergétique -->
            <div class="col-12 col-md-4 d-grid gap-2 grid-gap">
                <input class="hidden-input unique-radio-3" type="radio" id="renovation_energetique" name="travaux" value="renovation_energetique" data-type="radio">
                <label for="renovation_energetique" id="labelRenovationEnergetique" class="custom-btn-container nature-label" data-category="RenovationEnergetique">
                    <div class="custom-circle">
                        <img src="asset/img/Logos+Elements graphiques/Renovation energetique.svg" alt="Rénovation Énergétique Icon" />
                    </div>
                    <div class="label-texte">
                        <span>Rénovation énergétique</span>
                    </div>
                </label>
            </div>
            <!-- Décoration et/ou aménagement -->
            <div class="col-12 col-md-4 d-grid gap-2 grid-gap">
                <input class="hidden-input unique-radio-4" type="radio" id="decoration_amenagement" name="travaux" value="decoration_amenagement" data-type="radio">
                <label for="decoration_amenagement" id="labelDecorationAmenagement" class="custom-btn-container nature-label" data-category="DecorationAmenagement">
                    <div class="custom-circle">
                        <img src="asset/img/Logos+Elements graphiques/Decoration.svg" alt="Décoration et/ou Aménagement Icon" />
                    </div>
                    <div class="label-texte">
                        <span>Décoration et/ou aménagement</span>
                    </div>
                </label>
            </div>
            <!-- Cuisine et/ou salle de bain -->
            <div class="col-12 col-md-4 d-grid gap-2 grid-gap">
                <input class="hidden-input unique-radio-5" type="radio" id="cuisine_salle_bain" name="travaux" value="cuisine_salle_bain" data-type="radio">
                <label for="cuisine_salle_bain" id="labelCuisineSalleBain" class="custom-btn-container nature-label" data-category="CuisineSalleBain">
                    <div class="custom-circle">
                        <img src="asset/img/Logos+Elements graphiques/Cuisine Salle de bain.svg" alt="Cuisine et/ou Salle de Bain Icon" />
                    </div>
                    <div class="label-texte">
                        <span>Cuisine et/ou salle de bain</span>
                    </div>
                </label>
            </div>
            <!-- Autre -->
            <div class="col-12 col-md-4 d-grid gap-2 grid-gap">
                <input class="hidden-input unique-radio-6" type="radio" id="autre" name="travaux" value="autre" data-type="radio">
                <label for="autre" id="labelAutre" class="custom-btn-container nature-label" data-category="Autre">
                    <div class="custom-circle">
                        <img src="asset/img/Logos+Elements graphiques/Autre.svg" alt="Autre Icon" />
                    </div>
                    <div class="label-texte">
                        <span>Autre</span>
                    </div>
                </label>
            </div>
        </div>
        <div class="col-12 error-container d-none text-start mt-3" id="error-travaux">
            <p>Veuillez choisir un de ces champs</p>
        </div>
    </div>
    <div class="btnForm btn-form-nature">
        <div class="row justify-content-center justify-content-md-end">
            <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
        </div>
    </div>
</div>
