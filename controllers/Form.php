<?php
declare(strict_types=1);

namespace Controllers;

use App\Controller;
use Controllers\ApiClient;

class Form extends Controller
{
    private $_lead;
    private $_saveDatas;
    private $_apiClient;

    public function __construct()
    {
        $this->initSession();

        // $this->_lead = $this->loadModel('Lead');
        // $this->_saveDatas = $this->loadModel('SaveDatas');
        $this->_apiClient = new ApiClient();
    }

    private function initSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start([
                'lifetime' => 0,
                'path' => '/',
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            ]);
        }
    }

    private function getUuidFromRequest()
    {
        return $_GET['uuid'] ?? null;
    }

    public function index()
    {
        $uuid = $this->getUuidFromRequest();
        $savedData = null;
        $toastMessage = null;

        if ($uuid) {
            // $savedDataEntry = $this->_saveDatas->getLeadByUuid($uuid);
            $toastMessage = 'Ravi de vous revoir !';
            if ($savedDataEntry) {
                $savedData = json_decode($savedDataEntry['formData'], true);
            }
        }

        $data = [
            'uuid' => $uuid,
            'errors' => [],
            'savedData' => $savedData,
            'toastMessage' => $toastMessage
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postData = $this->sanitizeData($this->convertToUTF8($_POST));

            if (!isset($_SESSION['insertion_completed'])) {
                $insertionSuccess = $this->_lead->insert($postData, 'lead');
                $_SESSION['insertion_completed'] = true;
            } else {
                $insertionSuccess = true;
            }

            if ($insertionSuccess) {
                if (!isset($_SESSION['api_sent'])) {
                    $lastId = $this->_lead->getLastId();
                    $leadData = $this->_lead->getLeadById($lastId);
                    $responseCode = $this->_apiClient->sendApi($leadData);
                    $_SESSION['api_sent'] = true;
                } else {
                    $responseCode = 'ok';
                }

                $_SESSION['tracking_info'] = [
                    'transaction_id' => $_SESSION['idContactClient'],
                    'item_name' => 'devapp.solutis.fr',
                    'item_category' => 'rachatdecredit'
                ];

                if ($responseCode === "ok") {
                    $_SESSION['leadData'] = $postData;
                    header('Location: /demande-rachat-credit,reussie.html');
                    exit();
                } else {
                    $_SESSION['error'] = 'Une erreur est survenue lors du traitement de votre demande.';
                    header('Location: /demande-credit,avis-defavorable.html');
                    exit();
                }
            } else {
                $this->renderFormView('index', $data);
            }
        } else {
            $this->renderFormView('index', $data);
        }
    }

    private function convertToUTF8(array $data)
    {
        array_walk_recursive($data, function (&$item) {
            if (is_string($item)) {
                $item = mb_convert_encoding($item, 'UTF-8', mb_detect_encoding($item));
            }
        });
        return $data;
    }

    private function sanitizeData(array $data)
    {
        $cleanedData = [];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
            if ($key === 'email') {
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $value = null;
                }
            }
            $cleanedData[$key] = $value;
        }
        return $cleanedData;
    }

    public function saveFormData()
    {
        header('Content-Type: application/json');

        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        if (empty($data['emailSave']) || !filter_var($data['emailSave'], FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Adresse email manquante ou invalide.']);
            exit;
        }

        // $uuid = !empty($data['uuid']) ? $data['uuid'] : $this->_saveDatas->generateUuid();

        $formDataJson = json_encode($data);

        if ($this->_saveDatas->getLeadByUuid($uuid)) {
            $insertionSuccess = $this->_saveDatas->update($uuid, $formDataJson);
        } else {
            $insertionSuccess = $this->_saveDatas->insert($uuid, $formDataJson);
        }

        if ($insertionSuccess) {
            $to = $data['emailSave'];
            $subject = "Votre lien personnalisé pour reprendre votre formulaire";
            $message = "Merci de vous être enregistré. Veuillez cliquer sur le lien suivant pour reprendre le formulaire : <a href='https://devapp.solutis.fr/demande-rachat-credit.html?uuid={$uuid}'>cliquer ici</a>";
            $headers = "From: no-reply@solutis.fr\r\nContent-Type: text/html; charset=UTF-8\r\n";

            if (mail($to, $subject, $message, $headers)) {
                echo json_encode(['success' => true, 'message' => 'Données enregistrées avec succès. Email envoyé.', 'uuid' => $uuid]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Données enregistrées mais échec de l\'envoi de l\'email.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement des données.']);
        }
    }
}
