<?php
declare(strict_types=1);

namespace Models;

use App\Model;
use PDO;
use PDOException;
use Normalizer;

class Lead extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function normalizeString(string $str): string
    {
        $str = mb_strtolower($str, 'UTF-8');
        $str = Normalizer::normalize($str, Normalizer::FORM_D);
        $str = preg_replace('/[\p{Mn}]/u', '', $str);
        $str = preg_replace('/[^a-z0-9-]/', '', $str);
        return $str;
    }

    public function insert(array $data, string $table): bool
    {
        $data['cgv'] = isset($data['cgv']) ? 1 : 0;
        $coEmprunteurNecessaire = ['marie', 'pacse', 'union'];
        $data['coEmprunteur'] = isset($data['situationFamiliale']) && in_array($data['situationFamiliale'], $coEmprunteurNecessaire) ? 1 : 0;

        $mappedData = $this->mapProfessionAndContractType($data);
        $data['typeContratAutre'] = '';
        $data['typeContratAutreCo'] = '';

        $professionNormalized = isset($mappedData['professionXML']) ? $this->normalizeString($mappedData['professionXML']) : null;
        $professionCoNormalized = isset($mappedData['professionCoXML']) ? $this->normalizeString($mappedData['professionCoXML']) : null;

        switch ($professionNormalized) {
            case 'fonctionnaire':
                $data['typeContratFonctionnaire'] = $mappedData['typeContratXML'] ?? '';
                break;
            case 'salarieduprive':
                $data['typeContratSp'] = $mappedData['typeContratXML'] ?? '';
                break;
            case 'professionliberale':
                $data['typeContratAutre'] = 'PROFESSION' ?? '';
                break;
            default:
                $data['typeContratAutre'] = $mappedData['typeContratXML'] ?? 'AUTRE';
                break;
        }

        if (isset($data['coEmprunteur']) && !empty($professionCoNormalized)) {
            switch ($professionCoNormalized) {
                case 'fonctionnaire':
                    $data['typeContratFonctionnaireCo'] = $mappedData['typeContratCoXML'] ?? '';
                    break;
                case 'salarieduprive':
                    $data['typeContratSpCo'] = $mappedData['typeContratCoXML'] ?? '';
                    break;
                case 'professionliberale':
                    $data['typeContratAutreCo'] = 'PROFESSION' ?? '';
                    break;
                default:
                    $data['typeContratAutreCo'] = $mappedData['typeContratCoXML'] ?? 'AUTRE';
                    break;
            }
        }

        $host = $_SERVER['HTTP_HOST'];
        $data['origine'] = $data['codeOrigine'] = preg_match('/(app|devapp)\.solutis\.fr/', $host) ? 'solutis.fr' : 'default';

        $data['adresseIp'] = $_SESSION['Adresse_Ip'];
        $data['dateContact'] = date('Y-m-d H:i:s');
        $data['typeForm'] = 'appFormRacSolutis';
        $data['portable'] = $data['telephone'] ?? null;
        $data['foyer'] = 1 + ($data['coEmprunteur'] ?? 0) + ((int)($data['nbEnfant'] ?? 0));

        $data['dateNaissance'] = isset($data['dateNaissance']) ? $this->convertDateToMySQLFormat($data['dateNaissance']) : null;
        $data['debutActivite'] = isset($data['debutActivite']) ? $this->convertDateToMySQLFormat($data['debutActivite']) : null;
        $data['debutActiviteCo'] = isset($data['debutActiviteCo']) ? $this->convertDateToMySQLFormat($data['debutActiviteCo']) : null;

        $numericFields = [
            'loyerLocataire', 'valeurLocataire', 'valeurHeberge', 'valeurProprietaire', 'revenus', 'revenusCo',
            'autresDettesEmprunteur', 'autresRevenus', 'autresRevenusCo', 'besoinTresorerie', 'montantConso',
            'mensualiteConso', 'montantImmo', 'mensualiteImmo', 'cgv'
        ];

        foreach ($numericFields as $field) {
            $data[$field] = isset($data[$field]) && is_numeric($data[$field]) ? $data[$field] : 0;
        }

        $data['tresorerieYesOrNot'] = isset($data['tresorerieYesOrNot']) && $data['tresorerieYesOrNot'] === "oui" ? 1 : 0;

        $textFields = [
            'civilite', 'nom', 'prenom', 'emprunt', 'codePostal', 'ville', 'adresse1', 'telephone', 'portable',
            'email', 'profession', 'situationFamiliale', 'logement', 'precisionLogement', 'professionCo',
            'proprietaireLocataire', 'proprietaireHeberge', 'professionLiberale', 'professionLiberaleCo'
        ];

        foreach ($textFields as $textField) {
            $data[$textField] = $data[$textField] ?? null;
        }

        $integerFields = [
            'autresRevenusCo', 'autresChargesEmprunteur', 'autresDettesEmprunteur', 'revenus', 'revenusCo',
            'autresRevenus', 'loyerLocataire', 'besoinTresorerie', 'nbConso', 'montantConso', 'mensualiteConso',
            'nbImmo', 'montantImmo', 'mensualiteImmo', 'nbEnfant', 'valeurProprietaire', 'valeurLocataire',
            'valeurHeberge', 'nbBien'
        ];

        foreach ($integerFields as $field) {
            $data[$field] = isset($data[$field]) && is_numeric($data[$field]) ? (int)$data[$field] : 0;
        }

        $validColumns = $this->getValidColumns();
        $data = array_intersect_key($data, array_flip($validColumns));
        $columnsList = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO `{$table}` ($columnsList) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur d'insertion : " . $e->getMessage();
            return false;
        }
    }

    public function mapTypeContrat(string $profession, string $typeContrat): string
    {
        $mappings = [
            'fonctionnaire' => [
                'contractuel' => 'CONTRACTUEL',
                'intérimaire' => 'INTERIM',
                'titulaire' => 'TITULAIRE',
                'stagiaire' => 'STAGIAIRE',
            ],
            'salarié_privé' => [
                'cdi' => 'CDI',
                'cdi_interimaire' => 'CDI',
                'cdd' => 'CDD',
                'interimaire' => 'INTERIM',
                'stagiaire' => 'STAGIAIRE',
            ],
        ];

        return $mappings[$profession][$typeContrat] ?? $typeContrat;
    }

    public function mapProfessionAndContractType(array $data): array
    {
        $profession = $data['profession'] ?? '';
        $professionCo = $data['professionCo'] ?? '';
        $typeContratFonctionnaire = $data['typeContratFonctionnaire'] ?? '';
        $typeContratSp = $data['typeContratSp'] ?? '';
        $typeContratFonctionnaireCo = $data['typeContratFonctionnaireCo'] ?? '';
        $typeContratSpCo = $data['typeContratSpCo'] ?? '';

        $professionXML = '';
        $typeContratXML = '';
        $professionCoXML = '';
        $typeContratCoXML = '';

        switch ($profession) {
            case 'fonctionnaire':
                $professionXML = 'Fonctionnaire';
                $typeContratXML = $this->mapTypeContrat('fonctionnaire', $typeContratFonctionnaire);
                break;
            case 'profession_libérale':
                $professionXML = 'Profession liberale';
                $typeContratXML = 'PROFESSION';
                break;
            case 'salarié_privé':
                $professionXML = 'Salarié(e) du privé';
                $typeContratXML = $this->mapTypeContrat('salarié_privé', $typeContratSp);
                break;
            case 'chef_entreprise':
                $professionXML = 'Chef d entreprise';
                $typeContratXML = 'TNS';
                break;
            case 'artisan_commerçant':
                $professionXML = 'Artisans commercants';
                $typeContratXML = 'TNS';
                break;
            case 'retraité':
                $professionXML = 'Retraites';
                $typeContratXML = 'RETRAITE';
                break;
            case 'sans_emploi':
                $professionXML = 'Sans activite professionnelle';
                $typeContratXML = 'AUTRE';
                break;
            case 'autre':
                $professionXML = 'Autre';
                $typeContratXML = 'AUTRE';
                break;
            default:
                $professionXML = 'Employes';
                $typeContratXML = 'CDI';
        }

        if (!empty($professionCo)) {
            switch ($professionCo) {
                case 'fonctionnaire':
                    $professionCoXML = 'Fonctionnaire';
                    $typeContratCoXML = $this->mapTypeContrat('fonctionnaire', $typeContratFonctionnaireCo);
                    break;
                case 'profession_libérale':
                    $professionCoXML = 'Profession liberale';
                    $typeContratCoXML = 'PROFESSION';
                    break;
                case 'salarié_privé':
                    $professionCoXML = 'Salarié(e) du privé';
                    $typeContratCoXML = $this->mapTypeContrat('salarié_privé', $typeContratSpCo);
                    break;
                case 'chef_entreprise':
                    $professionCoXML = 'Chef d entreprise';
                    $typeContratCoXML = 'TNS';
                    break;
                case 'artisan_commerçant':
                    $professionCoXML = 'Artisans commercants';
                    $typeContratCoXML = 'TNS';
                    break;
                case 'retraité':
                    $professionCoXML = 'Retraites';
                    $typeContratCoXML = 'RETRAITE';
                    break;
                case 'sans_emploi':
                    $professionCoXML = 'Sans activite professionnelle';
                    $typeContratCoXML = 'AUTRE';
                    break;
                case 'autre':
                    $professionCoXML = 'Autre';
                    $typeContratCoXML = 'AUTRE';
                    break;
                default:
                    $professionCoXML = 'Employes';
                    $typeContratCoXML = 'CDI';
                    break;
            }
        }
        return [
            'professionXML' => $professionXML,
            'typeContratXML' => $typeContratXML,
            'professionCoXML' => $professionCoXML,
            'typeContratCoXML' => $typeContratCoXML,
        ];
    }

    public function getValidColumns(): array
    {
        return [
            'id', 'autresRevenusCo', 'origine', 'codeOrigine', 'adresseIp', 'dateContact', 'typeForm', 'foyer',
            'civilite', 'nom', 'prenom', 'codePostal', 'ville', 'adresse1', 'telephone', 'portable', 'email',
            'coEmprunteur', 'dateNaissance', 'autresChargesEmprunteur', 'autresDettesEmprunteur', 'cgv', 'revenus',
            'revenusCo', 'autresRevenus', 'loyerLocataire', 'fichageBanque', 'tresorerieYesOrNot', 'besoinTresorerie',
            'nbConso', 'montantConso', 'mensualiteConso', 'nbImmo', 'montantImmo', 'mensualiteImmo', 'profession',
            'statutFonctionnaire', 'statutFonctionnaireCo', 'typeContratSp', 'typeContratSpCo', 'typeContratFonctionnaire',
            'typeContratFonctionnaireCo', 'typeContratAutre', 'typeContratAutreCo', 'statutSp', 'statutSpCo',
            'statutAutre', 'statutAutreCo', 'debutActiviteCo', 'debutActivite', 'situationFamiliale', 'nbEnfant',
            'logement', 'precisionLogement', 'valeurProprietaire', 'valeurLocataire', 'valeurHeberge', 'nbBien',
            'professionCo', 'proprietaireLocataire', 'proprietaireHeberge', 'professionLiberale', 'professionLiberaleCo'
        ];
    }

    public function convertDateToMySQLFormat(string $dateString): ?string
    {
        $date = \DateTime::createFromFormat('d/m/Y', $dateString);
        return $date ? $date->format('Y-m-d') : null;
    }

    public function getLeadById(int $id): ?array
    {
        $sql = "SELECT * FROM lead WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getLastId(): int
    {
        try {
            $stmt = $this->pdo->query("SELECT MAX(id) FROM lead");
            $maxId = $stmt->fetchColumn();
            return (int) $maxId;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }
}
