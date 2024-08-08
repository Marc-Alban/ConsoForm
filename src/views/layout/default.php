<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}

$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$segments = explode('/', $request_uri);
$code_origine = $segments[0] ?? '';

if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params([
        "lifetime" => 0,
        "path" => "/",
        "domain" => $_SERVER["HTTP_HOST"],
        "secure" => true,
        "httponly" => true,
        "samesite" => "None",
    ]);
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K92ZV82');
    </script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Autres liens et méta-données -->
    <link rel="stylesheet" type="text/css" href="asset/css/solutis.css">
    <link rel="stylesheet" type="text/css" href="asset/css/stylebtn.css">
    <link rel="stylesheet" type="text/css" href="asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="asset/css/resp.css">
    <link rel="stylesheet" type="text/css" href="asset/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="asset/css/fontawesome.min.css">
    <style>
        .fa-classic,
        .fa-regular,
        .fa-solid,
        .far,
        .fas {
            font-family: "Font Awesome 6 Free";
        }

        .fa,
        .fa-brands,
        .fa-classic,
        .fa-regular,
        .fa-sharp,
        .fa-solid,
        .fab,
        .far,
        .fas {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: var(--fa-display, inline-block);
            font-style: normal;
            font-variant: normal;
            line-height: 1;
            text-rendering: auto;
        }

        .fa-arrow-right {
            float: right;
            padding-top: 3px;
        }

        #resultsList, #resultsListNaissance, #resultsListNaissanceCo {
            display: none;
            position: absolute;
            z-index: 1000;
            background: white;
            border: 1px solid #ccc;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #resultsList li, #resultsListNaissance li, #resultsListNaissanceCo li {
            padding: 5px;
            cursor: pointer;
        }

        #resultsList li:hover, #resultsListNaissance li:hover, #resultsListNaissanceCo li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K92ZV82" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <main>
        <?php
        if (isset($errors) && is_array($errors)) {
            foreach ($errors as $field => $messages) {
                if (is_array($messages)) {
                    echo "<div>" . htmlspecialchars($field) . "</div>";
                    foreach ($messages as $message) {
                        echo "<p>" . htmlspecialchars($message) . "</p>";
                    }
                } else {
                    echo "<p>" . htmlspecialchars($messages) . "</p>";
                }
            }
        }
        ?>

        <?= $content ?>

        <!-- Modal save -->
        <div class="modal fade" id="ModalSave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <i class="fa-regular fa-circle-xmark close-modal fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body" style="margin-top: -30px;">
                        <h3 class="text-center fw-bold pt-0">Sauvegardez vos informations</h3>
                        <p class="text-center mt-3">Saisissez votre adresse e-mail pour enregistrer vos informations et reprendre votre demande plus tard</p>
                        <div class="row justify-content-center mt-3">
                            <div class="col-10">
                                <input type="email" id="emailSave" name="emailSave" placeholder="Votre adresse email" class="form-input col-12" data-type="email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-danger btn-modal btn-cta" id="save">J'enregistre</button>
                        <button type="button" class="btn btn-primary btn-modal btn-cta close-modal">Je continue ma demande</button>
                        <div class="col-8 mt-3">
                            <p class="text-center" data-bs-dismiss="modal" id="redirection"><u>Non merci, je quitte sans sauvegarder</u></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Proposition -->
        <div class="modal fade proposition-modal" id="propositionModal" tabindex="-1" aria-labelledby="propositionModalLabel" aria-hidden="true">
            <div class="modal-dialog modale-propositon modal-dialog-centered">
                <div class="modal-content proposition-content">
                    <div class="modal-body d-flex p-0 proposition-body">
                        <div class="col-6 proposition-left">
                            <h3 class="text-center fw-bold">Nous vous proposons...</h3>
                            <p class="text-center mt-3">Vous avez déclaré plusieurs crédits en cours, souhaitez-vous poursuivre votre projet par une demande de <strong>rachat de crédits</strong> en intégrant votre trésorerie supplémentaire ?</p>
                            <div class="d-flex flex-column align-items-center">
                                <button type="button" class="btn btn-danger my-2 w-75">Je fais une demande de rachat de crédits</button>
                                <button type="button" class="btn btn-link my-2">Non, je continue ma demande de crédit conso</button>
                            </div>
                        </div>
                        <div class="col-6 proposition-right">
                            <h3>Financer votre projet tout en regroupant vos crédits ? C'est possible !</h3>
                            <div class="chart-wrapper">
                                <div>
                                    <p>Avant</p>
                                    <img src="asset/img/Graphique Avant.svg" alt="Avant">
                                </div>
                                <div>
                                    <p>Après</p>
                                    <img src="asset/img/Graphique Après.svg" alt="Après">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    
    <script>
        window.currentStep = 0;
    </script>
    <script src="asset/js/sidebar.js"></script>
    <script src="asset/js/btnMoreAndLess.js"></script>
    <script src="asset/js/dateFormat.js"></script>
    <script src="asset/js/saveForm.js"></script>
    <script src="asset/js/changeStep.js"></script>
    <script src="asset/js/formValidator.js" defer></script>


    <!-- Script pour auto-complétion des adresses -->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina", 
        "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", 
        "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", 
        "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Central African Republic", 
        "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic of the", "Congo, Republic of the", 
        "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", 
        "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", 
        "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", 
        "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", 
        "Israel", "Italy", "Ivory Coast", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", 
        "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Madagascar", 
        "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", 
        "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", 
        "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", 
        "Pakistan", "Palau", "Palestine State", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", 
        "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", 
        "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", 
        "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Korea", "South Sudan", "Spain", 
        "Sri Lanka", "Sudan", "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", 
        "Timor-Leste", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", 
        "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America", "Uruguay", "Uzbekistan", "Vanuatu", 
        "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];

    const zipCodeInput = document.getElementById('codePostal');
    const cityInput = document.getElementById('ville');
    const resultsList = document.getElementById('resultsList');

    const cityNaissanceInput = document.getElementById('villeNaissance');
    const resultsListNaissance = document.getElementById('resultsListNaissance');

    const cityNaissanceCoInput = document.getElementById('villeNaissanceCo');
    const resultsListNaissanceCo = document.getElementById('resultsListNaissanceCo');

    const paysNaissanceSelects = document.querySelectorAll('#paysNaissance');

    // Inject the countries into the select elements
    paysNaissanceSelects.forEach(select => {
        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country;
            option.textContent = country;
            select.appendChild(option);
        });
    });

    function fetchAddressData(query, callback, resultsList) {
        if (!navigator.onLine) {
            console.error('No internet connection');
            return;
        }

        if (query.length < 2) {
            resultsList.innerHTML = '';
            resultsList.style.display = 'none';
            return;
        }

        const url = `https://api-adresse.data.gouv.fr/search/?q=${query}&type=municipality&limit=20`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const features = data.features;
                const isZipCode = /^\d{2,5}$/.test(query);
                callback(features, isZipCode, resultsList);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function updateResultsList(features, isZipCode, resultsList) {
        resultsList.innerHTML = '';
        if (features.length > 0) {
            resultsList.style.display = 'block';
            features.forEach(feature => {
                let city = feature.properties.city;
                const zipCode = feature.properties.postcode;

                city = city.replace(/(\d+)(e)?(\s+Arrondissement)?/i, '$1').trim();

                const li = document.createElement('li');
                li.textContent = isZipCode ? city : `${city} (${zipCode})`;
                li.style.cursor = 'pointer';
                li.addEventListener('click', () => {
                    let cleanedCity = city.replace(/\d+/g, ''); // Remove any numbers from the city
                    if (resultsList.id === 'resultsList') {
                        cityInput.value = cleanedCity.trim(); // Set the value after removing numbers
                        zipCodeInput.value = zipCode;
                    } else if (resultsList.id === 'resultsListNaissance') {
                        cityNaissanceInput.value = cleanedCity.trim();
                    } else if (resultsList.id === 'resultsListNaissanceCo') {
                        cityNaissanceCoInput.value = cleanedCity.trim();
                    }
                    resultsList.innerHTML = '';
                    resultsList.style.display = 'none';
                });
                resultsList.appendChild(li);
            });
        } else {
            resultsList.style.display = 'none';
        }
    }

    if (zipCodeInput) {
        zipCodeInput.addEventListener('input', function() {
            const query = this.value.trim();
            fetchAddressData(query, updateResultsList, resultsList);
        });
    }

    if (cityInput) {
        cityInput.addEventListener('input', function() {
            const query = this.value.trim();
            fetchAddressData(query, updateResultsList, resultsList);
        });
    }

    if (cityNaissanceInput) {
        cityNaissanceInput.addEventListener('input', function() {
            const query = this.value.trim();
            fetchAddressData(query, updateResultsList, resultsListNaissance);
        });
    }

    if (cityNaissanceCoInput) {
        cityNaissanceCoInput.addEventListener('input', function() {
            const query = this.value.trim();
            fetchAddressData(query, updateResultsList, resultsListNaissanceCo);
        });
    }

    document.addEventListener('click', function(e) {
        if (resultsList && !resultsList.contains(e.target) && cityInput && !cityInput.contains(e.target) && zipCodeInput && !zipCodeInput.contains(e.target) &&
            resultsListNaissance && !resultsListNaissance.contains(e.target) && cityNaissanceInput && !cityNaissanceInput.contains(e.target) &&
            resultsListNaissanceCo && !resultsListNaissanceCo.contains(e.target) && cityNaissanceCoInput && !cityNaissanceCoInput.contains(e.target)) {
            if (resultsList) {
                resultsList.innerHTML = '';
                resultsList.style.display = 'none';
            }
            if (resultsListNaissance) {
                resultsListNaissance.innerHTML = '';
                resultsListNaissance.style.display = 'none';
            }
            if (resultsListNaissanceCo) {
                resultsListNaissanceCo.innerHTML = '';
                resultsListNaissanceCo.style.display = 'none';
            }
        }
    });
});

</script>

</script>


    </body>
</html>