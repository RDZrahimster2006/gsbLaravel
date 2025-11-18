<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdoGsb;

class SupprimerController extends Controller
{
    public function index(Request $request)
    {

        if (session('visiteur') != null) {
            $visiteur = session('visiteur');
          
            
            //$idVisiteur = $visiteur['nom']; 
            
            $lesvisiteurs = PdoGsb::getTousLesVisiteurs();

            return view('supprimer')
                ->with('visiteur', $visiteur)
                ->with('visiteurs', $lesvisiteurs);
        } else {
            return redirect()->route('chemin_connexion');
        }
    }

    public function supprimer(Request $request)
    {
        //dd($request);
        if (!session('visiteur')) {
            return redirect()->route('chemin_connexion');
        }
        elseif (session('visiteur') != null) {
            $visiteur = session('visiteur');}
          
        $id = $request["jsp"];
        //dd($id);
    

        try {
            PdoGsb::supprimerVisiteur($id);
            return redirect()
                ->route('chemin_supprimer')
                ->with('message', "Le visiteur {$visiteur['nom']} {$visiteur['prenom']} a bien été supprimé."); // ⚠ ['nom'], ['prenom']
        } catch (\Exception $e) {
            return redirect()
                ->route('chemin_supprimer');
                //->with('message', "Erreur lors de la suppression : " . $e->getMessage());
        }
    }
}
