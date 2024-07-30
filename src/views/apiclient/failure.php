<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
  <title>Échec de la demande</title>
  <link rel="stylesheet" href="asset/css/all.min.css">
  <link rel="stylesheet" href="asset/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    header { text-align: center; padding: 0; margin: 0; background-color: #fff; }
    header .logo { text-align: center; margin-top: 48px; }
    header h1 { color: #000; font-size: 18px; margin-top: 64px; }
    .text-blue { color: #4738de; }
    .container-def { margin-top: 250px; }
    .text-1, .text-2, .text-3, .text-4 { margin-top: 48px; font-size: 18px; }
    .hr-def { margin-top: 24px; background-color: transparent; border-top: 2px solid #4738de; }
    @media screen and (max-width: 768px) {
      .container-def { margin-top: 50px; }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <!-- Insert your SVG logo here -->
    </div>
  </header>
  <div class="container container-def">
    <h5 class="text-center text-blue fw-bold">AVIS DÉFAVORABLE</h5>
    <p class="text-center text-1">Vous nous avez consulté pour une étude de financement et nous vous en remercions.</p>
    <p class="text-center text-2">Nous avons le regret de vous informer que nous ne pouvons y répondre favorablement. En effet, nous ne pouvons
      procéder à l'étude de votre situation compte tenu des éléments que nous avons en notre possession. Nous vous
      invitons à vérifier la saisie des informations transmises.</p>
    <hr class="hr-def">
    <p class="text-center text-3">Nous restons à votre entière disposition pour tout complément d'information</p>
    <p class="text-center text-4"><a href="https://www.solutis.fr">Terminer et retourner sur la page d'accueil →</a></p>
  </div>
</body>
</html>
