<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
    <style>
        .pre-selected {
            border: 2px solid #4CAF50;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-4 col-xl-3 px-0">
            <?php include 'formPage/sidebar.php'; ?>
        </div>
        <div class="col-12 col-lg-8 col-xl-9">
            <p class="exp text-end d-none d-md-block pt-5 pe-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <g id="Icon_ionic-ios-checkmark-circle-outline" data-name="Icon ionic-ios-checkmark-circle-outline" transform="translate(-3.375 -3.375)">
                        <path id="Tracé_18" data-name="Tracé 18" d="M21.482,13.062l-.908-.8a.212.212,0,0,0-.144-.053h0a.2.2,0,0,0-.144.053l-6.292,5.447L11.7,15.739a.223.223,0,0,0-.289,0l-.918.789a.16.16,0,0,0,0,.253l2.888,2.482a.98.98,0,0,0,.6.253,1.023,1.023,0,0,0,.6-.244h.005l6.9-5.957A.17.17,0,0,0,21.482,13.062Z" transform="translate(-2.609 -2.483)" fill="#ed2027" />
                        <path id="Tracé_19" data-name="Tracé 19" d="M13.375,4.721a8.65,8.65,0,1,1-6.12,2.534,8.6, 8.6,0,0,1,6.12-2.534m0-1.346a10,10,0,1,0,10,10,10,10,0,0,0-10-10Z" transform="translate(0 0)" fill="#ed2027" />
                    </g>
                </svg> | Demande <span style="color: #4738DE;">gratuite</span> et <span style="color: #4738DE;">sans engagement</span>
            </p>
            <div class="form-container">
                <?php if (isset($toastMessage)) : ?>
                    <div id="toastMessage" class="alert alert-success" role="alert">
                        <?= htmlspecialchars($toastMessage) ?>
                    </div>
                <?php endif; ?>
                <div class="form-wrapper" data-selection="<?= htmlspecialchars($_GET['selection'] ?? '', ENT_QUOTES, 'UTF-8') ?>">

                    <form id="myForm" method="POST" autocomplete="off" class="consumer_credit_steps" accept-charset="UTF-8">
                        <!-- Contenu du formulaire -->
                        <?php
                        // Sélectionner la vue à afficher en fonction du paramètre 'selection'
                        $selection = $_GET['selection'] ?? 'projet'; // Par défaut, afficher la vue projet

                        switch ($selection) {
                            case 'vehicule':
                                include 'formPage/vehicule.php';
                                break;
                            case 'travaux':
                                include 'formPage/natureTravaux.php'; // 02-content
                                break;
                            case 'projet':
                                include 'formPage/projet.php'; //0-content
                                break;
                        }

                        // Toujours inclure les étapes suivantes après la sélection initiale
                        include 'formPage/monCredit.php';
                        include 'formPage/situationPatrimoniale.php';
                        include 'formPage/situationFamilliale.php';
                        include 'formPage/situationPro.php';
                        include 'formPage/situationProCo.php';
                        include 'formPage/mesRevenus.php';
                        include 'formPage/mesRevenusCo.php';
                        include 'formPage/autresRevenus.php';
                        include 'formPage/plusieurCredit.php';
                        include 'formPage/chargeMensuellesDuFoyer.php';
                        include 'formPage/loyer.php';
                        include 'formPage/banque.php';
                        include 'formPage/coordonneesUn.php';
                        include 'formPage/coordonneeUnCo.php';
                        include 'formPage/coordonneesDeux.php';
                        ?>
                        <div id="loader" class="loader"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
