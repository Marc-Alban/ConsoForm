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
}
