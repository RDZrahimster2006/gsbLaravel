<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdoGsb;

class SupprimerController extends Controller
{
    /**
     * Affiche la liste des visiteurs à supprimer
     */
    public function index(Request $request)
    {
        if (!session('visiteur')) {
            return redirect()->route('chemin_connexion');
        }

        $visiteurs = PdoGsb::getTousLesVisiteurs();
        return view('supprimer')->with('visiteurs', $visiteurs);
        
    }

    /**
     * Supprime le visiteur sélectionné
     */
    public function supprimer(Request $request, $id)
    {
        if (!session('visiteur')) {
            return redirect()->route('chemin_connexion');
        }

        // Vérifie que le visiteur existe
        $visiteur = PdoGsb::getVisiteurById($id);
        if (!$visiteur) {
            return redirect()->route('chemin_supprimer')->with('message', "Visiteur introuvable.");
        }

        try {
            PdoGsb::supprimerVisiteur($id);
            return redirect()
                ->route('chemin_supprimer')
                ->with('message', "Le visiteur {$visiteur->nom} {$visiteur->prenom} a bien été supprimé.");
        } catch (\Exception $e) {
            return redirect()
                ->route('chemin_supprimer')
                ->with('message', "Erreur lors de la suppression : " . $e->getMessage());
        }
    }
}
