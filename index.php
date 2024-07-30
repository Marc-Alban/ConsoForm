<?php
declare(strict_types=1);

use Controllers\Form;
use Controllers\ApiClient;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

// Activer l'affichage des erreurs
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Configurer le fichier de log d'erreurs
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/logs/error.log'); // Assurez-vous que le dossier logs existe et est accessible en écriture

// Définition de la constante ROOT
define('ROOT', __DIR__ . '/');

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Vérifiez que les variables d'environnement sont chargées
$requiredEnvVars = [
    'DB_LOCAL_HOST', 'DB_LOCAL_NAME', 'DB_LOCAL_USER', 'DB_LOCAL_PASS',
    'DB_DEV_HOST', 'DB_DEV_NAME', 'DB_DEV_USER', 'DB_DEV_PASS',
    'DB_PROD_HOST', 'DB_PROD_NAME', 'DB_PROD_USER', 'DB_PROD_PASS'
];

foreach ($requiredEnvVars as $var) {
    if (!isset($_ENV[$var])) {
        throw new Exception("La variable d'environnement {$var} n'est pas définie.");
    }
}

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
        error_log("Handling saveFormData action");
        $formController->saveFormData();
        break;
    case 'loadFormData':
        error_log("Handling loadFormData action");
        $formController->loadFormData();
        break;
    default:
        error_log("Handling default action (index)");
        $formController->index();
        break;
}
?>
