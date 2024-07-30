<div class="container text-center situation_pro tab step" id="1-content">
    <div data-category="Credit"></div>
    <div class="title">
        <h2 class="text-primary offset-lg-4 col-12 col-md-12 col-lg-4  text-center">
            VÉHICULE
        </h2>
    </div>
    <div class="step1_1A_project col-12">
        <div class="row justify-content-center">
            <!-- Type de véhicule à financer -->
            <label for="typeVehicule" class="col-12 col-md-4 fw-bold text-start">Type de véhicule à financer :</label>
            <div class="select2-selection--single col-12 col-md-8">
                <select id="typeVehicule" name="typeVehicule" class="form-select form-input col-12" data-type="select">
                    <option value="" selected disabled>Sélectionner</option>
                    <option value="auto">Auto</option>
                    <option value="camping-car">Camping-car</option>
                    <option value="caravane">Caravane</option>
                    <option value="moto">Moto</option>
                    <option value="autre">Autre</option>
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-typeVehicule">
                    <p>Veuillez choisir parmi les champs proposés</p>
                </div>
            </div>

            <!-- État du véhicule -->
            <label for="etatVehicule" class="col-12 col-md-4 fw-bold text-start mt-4">État :</label>
            <div class="select2-selection--single col-12 col-md-8 mt-4">
                <select id="etatVehicule" name="etatVehicule" class="form-select form-input col-12" data-type="select">
                    <option value="" selected disabled>Sélectionner</option>
                    <option value="neuf">Neuf</option>
                    <option value="occasion_moins_2_ans">Occasion de moins de 2 ans</option>
                    <option value="occasion_plus_2_ans">Occasion de plus de 2 ans</option>
                </select>
                <div class="col-12 error-container d-none text-start mt-3" id="error-etatVehicule">
                    <p>Veuillez choisir parmi les champs proposés</p>
                </div>
            </div>
        </div>
    </div>
    <div class="btnForm mt-5">
        <div class="row justify-content-center justify-content-md-end">
            <button type="button" class="btn btn-light btnPrev"><i class="fa-solid fa-arrow-left"></i>Retour</button>
            <button type="button" class="btn btn-primary btnNext">Suivant<i class="fas fa-arrow-right"></i></button>
        </div>
    </div>
</div>
