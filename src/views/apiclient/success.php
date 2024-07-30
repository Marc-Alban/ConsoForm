<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['leadData'])) {
    $data = $_SESSION['leadData'];
    unset($_SESSION['leadData']);
}

if (isset($_SESSION['tracking_info'])) {
    $trackingInfo = $_SESSION['tracking_info'];
    echo "
    <script async src='https://www.googletagmanager.com/gtag/js?id=G-6NYNXGBKNT'></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());
      gtag('config', 'G-6NYNXGBKNT');
      gtag('event', 'purchase', {
        send_to: 'G-6NYNXGBKNT',
        transaction_id: '{$trackingInfo['transaction_id']}',
        currency: 'EUR',
        value: 1,
        items: [
          {
            item_id: '{$trackingInfo['transaction_id']}',
            item_name: '{$trackingInfo['item_name']}',
            item_category: '{$trackingInfo['item_category']}',
            price: 1,
            quantity: 1
          }
        ]
      });
    </script>";
    unset($_SESSION['tracking_info']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation de Demande</title>
  <link rel="stylesheet" href="asset/css/all.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    header { text-align: center; padding: 0; margin: 0; background-color: #fff; }
    header .logo { text-align: center; margin-top: 48px; }
    header h1 { color: #000; font-size: 18px; margin-top: 64px; }
    .text-blue { color: #4738de; }
    .bloc-etape, .bloc-dossier, .bloc-infos { border: 1px solid #4738de; border-radius: 20px; }
    .bloc-etape { height: 200px; }
    .bloc-dossier { min-height: 680px; }
    .bloc-infos { min-height: 435px; padding: 10px; box-shadow: 0px 0px 5px -1px lightslategrey; }
    .alert-primary { background-color: #d1d4ff !important; border: none !important; margin: 20px; }
    .btnEnd { background-color: #bff574 !important; border-color: #bff574 !important; color: #4738de !important; border-radius: 30px !important; padding: 15px !important; font-weight: bold !important; }
    .dossier-txt { margin: 30px; }
    .col-header, .col-header2 { background-color: #4738de; color: white; padding: 20px; }
    .col-header2 { border-top-right-radius: 16px; border-top-left-radius: 16px; }
    .col-txt { padding: 10px; }
    .espaceClient { display: flex; align-items: flex-start; justify-content: center; }
    .espaceClient img { width: 50px; }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <!-- Insert your SVG logo here -->
    </div>
    <h1>Merci M. <?php echo isset($data['nom']) ? htmlspecialchars($data['nom']) : ''; ?>, votre demande de rachat de crédits
      <span class="text-blue">a été complétée avec succès !</span>
    </h1>
  </header>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-xxl-5">
        <div class="row justify-content-center justify-content-xxl-end">
          <div class="col-11 mt-3">
            <div class="col-12 bloc-etape">
              <div class="col-12 col-header">
                <h5 class="text-center mb-0">PROCHAINE ÉTAPE</h5>
              </div>
              <div class="col-12 col-txt">
                <p class="text-center mt-3">Votre conseiller Solutis va vous rappeler dans les meilleurs délais</p>
                <p class="text-center mt-3"><a class="text-blue" target="_blank" href="https://www.solutis.fr/demande-rappel.html">Fixer un rdv téléphonique ou visio -></a></p>
              </div>
            </div>
          </div>
          <div class="col-11 mt-4">
            <div class="col-12 bloc-infos">
              <div class="col-12 col-header2">
                <h5 class="text-center text-blue">VOS INFORMATIONS</h5>
              </div>
              <div class="col-12 col-txt">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <p><b>Crédit(s) à la consommation</b></p>
                    <div class="row">
                      <div class="col-8">Mensualités :</div>
                      <div class="col-4 text-end"><?php echo isset($data['mensualiteConso']) ? htmlspecialchars($data['mensualiteConso']) : 0; ?> €</div>
                      <div class="col-8">Capital restant dû :</div>
                      <div class="col-4 text-end"><?php echo isset($data['montantConso']) ? htmlspecialchars($data['montantConso']) : 0; ?> €</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <p><b>Prêt(s) immobilier(s)</b></p>
                    <div class="row">
                      <div class="col-8">Mensualités :</div>
                      <div class="col-4 text-end"><?php echo isset($data['mensualiteImmo']) ? htmlspecialchars($data['mensualiteImmo']) : 0; ?> €</div>
                      <div class="col-8">Capital restant dû :</div>
                      <div class="col-4 text-end"><?php echo isset($data['montantImmo']) ? htmlspecialchars($data['montantImmo']) : 0; ?> €</div>
                    </div>
                  </div>
                  <div class="col-12 mt-3">
                    <p><b>Autres informations</b></p>
                  </div>
                  <div class="col-5">Besoin de trésorerie :</div>
                  <div class="offset-3 col-4 text-end"><?php echo isset($data['besoinTresorerie']) ? htmlspecialchars($data['besoinTresorerie']) : 0; ?> €</div>
                  <div class="col-5">Revenus du foyer :</div>
                  <div class="offset-3 col-4 text-end">
                    <?php
                    $totalRevenus = (isset($data['revenus']) ? $data['revenus'] : 0) + (isset($data['revenusCo']) ? $data['revenusCo'] : 0);
                    echo htmlspecialchars($totalRevenus);
                    ?> €
                  </div>
                  <div class="col-5">Autres revenus :</div>
                  <div class="offset-3 col-4 text-end">
                    <?php
                    $totalAutresRevenus = (isset($data['autresRevenus']) ? $data['autresRevenus'] : 0) + (isset($data['autresRevenusCo']) ? $data['autresRevenusCo'] : 0);
                    echo htmlspecialchars($totalAutresRevenus);
                    ?> €
                  </div>
                  <div class="col-5">Dettes :</div>
                  <div class="offset-3 col-4 text-end"><?php echo isset($data['autresDettesEmprunteur']) ? htmlspecialchars($data['autresDettesEmprunteur']) : 0; ?> €</div>
                  <div class="col-5">Loyers :</div>
                  <div class="offset-3 col-4 text-end"><?php echo isset($data['loyerLocataire']) ? htmlspecialchars($data['loyerLocataire']) : 0; ?> €</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-xxl-7">
        <div class="row justify-content-center justify-content-xxl-start">
          <div class="col-11 mt-3">
            <div class="col-12 bloc-dossier">
              <div class="col-12 col-header">
                <h5 class="text-center mb-0">COMPLÉTER VOTRE DOSSIER</h5>
              </div>
              <div class="col-12 col-txt">
                <div class="alert alert-primary text-center row m-4 espaceClient" role="alert">
                  <img class="img-fluid me-1 me-lg-3" src="../../asset/img/Lumiere.svg" alt="Lumiere Icon">
                  <p class="col-10 col-md-11">Grâce à <span class="fw-bold">l'Espace Client Solutis</span>, transférez rapidement vos documents depuis votre smartphone ou ordinateur et suivez facilement l'évolution de votre dossier de rachat de crédits</p>
                </div>
                <div class="col-12">
                  <p class="text-center dossier-txt">Un mail <span class="text-blue">récapitulant votre demande</span> et un <span class="text-blue">second pour activer votre espace client</span> vous ont été envoyés (vérifiez vos courriers indésirables en cas de non-réception)</p>
                  <p class="text-center"><a class="text-danger" target="_blank" href="https://doc.solutis.fr/TEMPLATE-CRM-SOLUTIS2/SOLUTIS_liste_documents_complete_24h.pdf">Télécharger la liste des documents <img src="../../asset/img/download.svg" alt="Download Icon" style="margin-left:5px;margin-top: -5px;"></a></p>
                  <p class="text-center text-danger"><a class="text-danger" target="_blank" href="https://doc.solutis.fr/convention-intermediation_SOLUTIS.pdf">Télécharger la convention d'intermédiation <img src="../../asset/img/download.svg" alt="Download Icon" style="margin-left:5px;margin-top: -5px;"></a></p>
                  <p class="text-center text-blue">VOUS POUVEZ ENVOYER VOS DOCUMENTS PAR :</p>
                  <p class="text-center"><i class="fa-solid fa-paper-plane text-blue"></i> Votre espace client (à activer par e-mail)</p>
                  <p class="text-center"><i class="fa-solid fa-at text-blue"></i> Email : demande@solutis.fr</p>
                  <p class="text-center"><i class="fa-solid fa-envelope text-blue"></i> Courrier : Solutis, 27 rue Jean-Jacques Mention, 80084 Amiens</p>
                  <div class="row mt-5">
                    <div class="col-12 text-center">
                      <a href="tel:+33223055222" class="btn btnEnd"><i class="fa-solid fa-phone"></i> 03 23 05 52 22</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
