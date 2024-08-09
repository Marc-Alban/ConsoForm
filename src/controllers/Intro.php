<?php

declare(strict_types=1);

namespace Controllers;

use App\Controller;

class Intro extends Controller
{
    /**
     * Méthode pour afficher la première page du formulaire.
     */
    public function index()
    {
        // Render the view located in views/firststep/intro.php
        $this->render('intro', [], 'firststep');
    }

    /**
     * Méthode pour gérer la sélection de projet et rediriger vers le contrôleur Form avec la bonne sélection.
     */
    public function handleSelection()
    {
        // Récupérer la sélection de l'utilisateur
        $selection = $_POST['selection'] ?? $_GET['selection'] ?? null;

        if ($selection) {
            // Redirection vers le contrôleur Form avec la sélection comme paramètre
            header("Location: index.php?action=form&selection=" . urlencode($selection));
            exit;
        } else {
            // Si aucune sélection, rediriger vers l'accueil ou afficher une erreur
            header("Location: index.php");
            exit;
        }
    }
}
