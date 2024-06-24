<?php
declare(strict_types=1);

use Controllers\Form;
use Controllers\ApiClient;

require_once __DIR__ . '/vendor/autoload.php';

// Activer l'affichage des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Configurer le fichier de log d'erreurs
ini_set('log_errors', '1');

// Définition de la constante ROOT
define('ROOT', __DIR__ . '/');

// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Définitions diverses
$isLocalhost = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
$_SESSION['Adresse_Ip'] = $isLocalhost ? '' : $_SERVER['REMOTE_ADDR'];

// Création d'une instance de contrôleur Form
$formController = new Form(new ApiClient());

// Gestion des actions
$action = $_GET['action'] ?? null;
switch ($action) {
    case 'saveFormData':
        $formController->saveFormData();
        break;
    default:
        $formController->index();
        break;
}
?>
