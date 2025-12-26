<?php
namespace App\Http\Controllers;
use App\Services\CompteEtudiantService;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class CompteEtudiantController extends Controller
{

    public function __construct(
        protected CompteEtudiantService $compteEtudiantService
    ) {}

    /**
     * Dashboard étudiant
     */
    public function dashboard()
    {
        //
    }

    /**
     * Afficher le profil de l'étudiant connecté
     */
    public function profil()
    {
        
    }

    /**
     * Mettre à jour le profil de l'étudiant
     */
    public function updateProfil(Request $request)
    {
        //
    }

    /**
     * Liste des espaces pédagogiques
     */
    public function espaces(Etudiant $etudiant)
    {
        $espaces = $this->compteEtudiantService->getMySpace($etudiant->id);

        return view('etudiantLayout.espaces.index', compact('espaces'));
    }

    /**
     * Détails d’un espace pédagogique
     */
    public function showEspace($espaceId)
    {
        //
        

    }

    /**
     * Liste des travaux de l'étudiant
     */
    public function travaux()
    {
        //
        return view('etudiantLayout.travaux.index');
    }

    /**
     * Détails d’un travail
     */
    public function showTravail($travailId)
    {
        //
    }

    /**
     * Liste des évaluations de l'étudiant
     */
    public function evaluations()
    {
        //
    }

    /**
     * Détails d’une évaluation
     */
    public function showEvaluation($evaluationId)
    {
        //
    }

    /**
     * Paramètres du compte (mot de passe, sécurité)
     */
    public function parametres()
    {
        //
    }

    /**
     * Mise à jour du mot de passe
     */
    public function updatePassword(Request $request)
    {
        //
    }
}
