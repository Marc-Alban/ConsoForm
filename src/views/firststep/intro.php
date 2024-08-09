<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crédit à la Consommation</title>
    <link rel="stylesheet" type="text/css" href="asset/css/firststep.css">
</head>
<body>
    <div class="container-fluid blockcontainer">
        <h1>Crédit à la consommation</h1>
        <p>Quel est mon projet ?</p>
        <div class="projects">
            <div class="project" data-selection="projet">
                <img src="/asset/img/Icons Premiere Page/Icon blanc/Icon Projet Personel - blanc.svg" alt="Projet Personnel" class="icon-default">
                <img src="/asset/img/Icons Premiere Page/Icon bleu/Icon Projet Personel - bleu.svg" alt="Projet Personnel" class="icon-hover">
                <p>PROJET PERSONNEL</p>
            </div>
            <div class="project" data-selection="vehicule">
                <img src="/asset/img/Icons Premiere Page/Icon blanc/Icon Vehicule - blanc.svg" alt="Véhicule" class="icon-default">
                <img src="/asset/img/Icons Premiere Page/Icon bleu/Icon Vehicule - bleu.svg" alt="Véhicule" class="icon-hover">
                <p>VÉHICULE</p>
            </div>
            <div class="project" data-selection="travaux">
                <img src="/asset/img/Icons Premiere Page/Icon blanc/Icon Travaux - blanc.svg" alt="Travaux" class="icon-default">
                <img src="/asset/img/Icons Premiere Page/Icon bleu/Icon Travaux - bleu.svg" alt="Travaux" class="icon-hover">
                <p>TRAVAUX</p>
            </div>
            <div class="project" data-selection="tresorerie">
                <img src="/asset/img/Icons Premiere Page/Icon blanc/Icon Tresorerie -blanc.svg" alt="Trésorerie" class="icon-default">
                <img src="/asset/img/Icons Premiere Page/Icon bleu/Icon Tresorerie - bleu.svg" alt="Trésorerie" class="icon-hover">
                <p>TRÉSORERIE</p>
            </div>
            <div class="project" data-selection="credit-renouvelable">
                <img src="/asset/img/Icons Premiere Page/Icon blanc/Icon Credit renouvelable - blanc.svg" alt="Crédit Renouvelable" class="icon-default">
                <img src="/asset/img/Icons Premiere Page/Icon bleu/Icon Credit renouvelable - bleu.svg" alt="Crédit Renouvelable" class="icon-hover">
                <p>CRÉDIT RENOUVELABLE</p>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.project').forEach(function(project) {
            project.addEventListener('click', function() {
                const selection = this.getAttribute('data-selection');
                window.location.href = 'index.php?action=form&selection=' + selection;
            });
        });
    </script>
</body>
</html>
