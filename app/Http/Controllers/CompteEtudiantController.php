<?php
namespace App\Http\Controllers;
use App\Services\CompteEtudiantService;
use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Espace;
use App\Models\Travail;

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

        $user = Auth::user()->load('etudiant.promotion', 'etudiant.filiere_option');
        return view('etudiantLayout.espaces.profil', [
            'user' => $user,
            'page_title' => 'Mon Profil'
        ]);
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
    public function espaces()
    {
            // On récupère l'étudiant connecté avec ses espaces, les matières et les formateurs liés
            $etudiant = Auth::user()->etudiant;
            $espaces = $etudiant->espaces()->with(['matiere', 'formateur'])->get();
        return view('etudiantLayout.espaces.index',[
                'espaces' => $espaces,
                'page_title' => 'Mes Espaces de Cours'
            ]);
    }



    /**
     * Détails d’un espace pédagogique
     */
    public function showEspace($id)
    {
        $etudiant = Auth::user()->etudiant;
        $espace = Espace::with(['matiere', 'formateur'])->findOrFail($id);

        // On récupère les travaux de cet espace QUI sont assignés à cet étudiant
        $travaux = Travail::where('espace_id', $id)
            ->where('statut', 'en_cours')
            ->whereHas('assignations', function($query) use ($etudiant) {
                $query->where(function($q) use ($etudiant) {
                    $q->where('etudiant_id', $etudiant->id)
                    ->orWhere('promotion_id', $etudiant->promotion_id);
                    // Ajoute orWhere('groupe_id', ...) si tu gères les groupes
                });
            })
            ->with(['assignations' => function($q) use ($etudiant) {
                // On récupère l'assignation spécifique pour avoir la date_fin
                $q->where('etudiant_id', $etudiant->id)
                ->orWhere('promotion_id', $etudiant->promotion_id);
            }])
            ->get();

        return view('etudiantLayout.espaces.show', compact('espace', 'travaux'));
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
