<?php
declare(strict_types=1);

namespace Controllers;

use Models\Lead;

class XmlConverter
{
    // public function array_to_xml($datas, Lead $lead)
    // {
    //     $data = $this->prepareXmlDataArray($datas, $lead);
    //     if (empty($data)) {
    //         return "<Lead>No data available</Lead>";
    //     }
    //     $xml = $this->generateXmlFromData($data);
    //     return trim($xml);
    // }

    private function getCspValue($professionName)
    {
        $cspValues = [
            'Aucun' => -1,
            'Agriculteurs exploitants' => 1,
            'Artisans commerçants' => 2,
            'Autre' => 3,
            'Sans activité professionnelle' => 4,
            'Cadre' => 5,
            'Employés' => 6,
            'Fonctionnaire' => 7,
            'Ouvriers' => 8,
            'Professions intermédiaires' => 9,
            'Retraités' => 10,
            'Intérimaire' => 11,
            'Ne souhaite pas répondre' => 12,
            'Chef d\'entreprise' => 13,
            'Profession libérale' => 14
        ];

        return $cspValues[$professionName] ?? null;
    }

    private function getProfessionValue($professionKey)
    {
        $professionKeys = [
            'fonctionnaire' => 'Fonctionnaire',
            'profession_libérale' => 'Profession libérale',
            'chef_entreprise' => 'Chef d\'entreprise',
            'salarié_privé' => 'Employés',
            'artisan_commerçant' => 'Artisans commerçants',
            'retraité' => 'Retraités',
            'sans_emploi' => 'Sans activité professionnelle',
            'autre' => 'Autre'
        ];

        return $professionKeys[$professionKey] ?? 'Autre';
    }

    private function prepareXmlDataArray($datas, Lead $lead)
    {
        if (isset($datas["coEmprunteur"]) && $datas["coEmprunteur"] == '1') {
            $coemprunteur = "Oui";
        } else {
            $coemprunteur = "Non";
        }

        if (isset($datas["debutActivite"])) {
            $debut = $datas["debutActivite"];
            $dateTimeDebut = \DateTime::createFromFormat('Y-m-d', $debut);
            $formattedDebut = $dateTimeDebut->format('d/m/Y');
            $debutActivite = $formattedDebut;
        }

        if (isset($datas["debutActiviteCo"])) {
            $debutCo = $datas["debutActiviteCo"];
            $dateTimeDebutCo = \DateTime::createFromFormat('Y-m-d', $debutCo);
            $formattedDebutCo = $dateTimeDebutCo->format('d/m/Y');
            $debutActiviteCo = $formattedDebutCo;
        }

        $dateNaissance = isset($datas["dateNaissance"]) ? $datas["dateNaissance"] : null;
        if ($dateNaissance) {
            $dateTimeN = \DateTime::createFromFormat('Y-m-d', $dateNaissance);
            if ($dateTimeN !== false) {
                $formattedDateN = $dateTimeN->format('d/m/Y');
                $dateNaissance = $formattedDateN;
            } else {
                $dateNaissance = null;
            }
        }

        $dateContact = isset($datas["dateContact"]) ? $datas["dateContact"] : null;
        if ($dateContact) {
            $dateTimeContact = \DateTime::createFromFormat('Y-m-d H:i:s', $dateContact);
            $dateContact = $dateTimeContact !== false ? $dateTimeContact->format('d/m/Y H:i:s') : null;
        } else {
            $dateContact = null;
        }

        $valeur = $datas['valeurProprietaire'] ?? $datas['valeurLocataire'] ?? $datas['valeurHeberge'] ?? '';
        $lastId = $lead->getLastId();
        $data['idContactClient'] = $lastId !== null ? 86100000 + $lastId : null;
        $_SESSION['idContactClient'] = $data['idContactClient'];

        $typeContrat = '';
        if (!empty($datas['typeContratSp'])) {
            $typeContrat = $datas['typeContratSp'];
        } elseif (!empty($datas['typeContratFonctionnaire'])) {
            $typeContrat = $datas['typeContratFonctionnaire'];
        } elseif (!empty($datas['typeContratAutre'])) {
            $typeContrat = $datas['typeContratAutre'];
        }

        $typeContratCo = '';
        if (!empty($datas['typeContratSpCo'])) {
            $typeContratCo = $datas['typeContratSpCo'];
        } elseif (!empty($datas['typeContratFonctionnaireCo'])) {
            $typeContratCo = $datas['typeContratFonctionnaireCo'];
        } elseif (!empty($datas['typeContratAutreCo'])) {
            $typeContratCo = $datas['typeContratAutreCo'];
        }

        $precisionLogement = '';
        if ($datas["precisionLogement"]) {
            if ($datas["precisionLogement"] == 'Parents' || $datas["precisionLogement"] == 'conjoint') {
                $precisionLogement = 'FAMILLE';
            } else {
                $precisionLogement = 'TIERS';
            }
        }

        $professionKeyE = $datas['profession'] ?? 'autre';
        $professionName = $this->getProfessionValue($professionKeyE);
        $cspValue = $this->getCspValue($professionName);
        $professionKeyCo = $datas['professionCo'] ?? 'autre';
        $professionNameCo = $this->getProfessionValue($professionKeyCo);
        $cspValueCo = $this->getCspValue($professionNameCo);

        $profession = isset($datas['profession']) ? $datas['profession'] : '';
        $professionCo = isset($datas['professionCo']) ? $datas['professionCo'] : '';
        
        $pv = isset($_COOKIE['pv']) ? $_COOKIE['pv'] : (isset($_GET['pv']) ? $_GET['pv'] : null);
        $typeform = isset($_COOKIE['typeform']) ? $_COOKIE['typeform'] : (isset($_GET['typeform']) ? $_GET['typeform'] : "Formulaire rac sur le site app.solutis.fr");
        $codeOrigine = $pv ?? $datas['codeOrigine'];

        $data = [
            "Origine" => $datas['origine'] ?? '',
            "CodeOrigine" => $codeOrigine,
            "Adresse_Ip" => $datas['adresseIp'] ?? '',
            "TypeForm" => $typeform,
            "Provenance" => "App Site web",
            "TypeProjet" => "RAC",
            "Foyer" => $datas["foyer"] ?? "",
            "Civilite" => $datas['civilite'] ?? '',
            "Nom" => $datas['nom'] ?? '',
            "Prenom" => $datas['prenom'] ?? '',
            "CodePostal" => $datas['codePostal'] ?? '',
            "Ville" => $datas['ville'] ?? '',
            "Adresse1" => $datas['adresse1'] ?? '',
            "Telephone" => $datas['telephone'] ?? '',
            "Email" => $datas['email'] ?? '',
            "SituationFamiliale" => $datas['situationFamiliale'] ?? '',
            "NbEnfant" => $datas['nbEnfant'] ?? 0,
            "Csp" => $cspValue ?? '',
            "CspCo" => $cspValueCo ?? '',
            "Profession" => $this->getProfessionValue($profession) ?? '',
            "ProfessionCo" => $this->getProfessionValue($professionCo) ?? '',
            "TypeContrat" => $typeContrat,
            "TypeContratCo" => $typeContratCo,
            "Revenus" => $datas['revenus'] ?? 0,
            "RevenusCo" => $datas['revenusCo'] ?? 0,
            "AutresRevenus" => $datas['autresRevenus'] ?? 0,
            "AutresRevenusCo" => $datas['autresRevenusCo'] ?? 0,
            "AutresCharges" => $datas['autresChargesEmprunteur'] ?? 0,
            "AutresDettes" => $datas['autresDettesEmprunteur'] ?? 0,
            "Valeur" => $valeur ?? 0,
            "Loyer" => $datas["loyerLocataire"] ?? 0,
            "Logement" => $datas['logement'] ?? 0,
            "MensualiteImmo" => $datas['mensualiteImmo'] ?? 0,
            "MensualiteConso" => $datas['mensualiteConso'] ?? 0,
            "NbConso" => $datas["nbConso"] ?? 0,
            "NbImmo" => $datas["nbImmo"] ?? 0,
            "MontantImmo" => $datas["montantImmo"] ?? 0,
            "MontantConso" => $datas["montantConso"] ?? 0,
            "DebutActivite" => $debutActivite ?? '',
            "DebutActiviteCo" => $debutActiviteCo ?? '',
            "DateNaissance" => $dateNaissance,
            "DateContact" => $dateContact,
            "FichageBanque" => $datas["fichageBanque"] ?? '',
            "BesoinTresorerie" => $datas["besoinTresorerie"] ?? 0,
            "IdContactClient" => $data["idContactClient"] ?? 0,
            "NatureProjet" => "",
            "coEmprunteur" => $coemprunteur,
            "PrecisionLogement" => $precisionLogement,
        ];

        return $data;
    }

    private function generateXmlFromData($data)
    {
        $xml = "<Lead>";

        foreach ($data as $nom => $valeur) {
            $xml .= "<$nom>" . htmlspecialchars((string) $valeur, ENT_XML1, 'UTF-8') . "</$nom>";
        }

        $xml .= "</Lead>";

        return $xml;
    }
}
