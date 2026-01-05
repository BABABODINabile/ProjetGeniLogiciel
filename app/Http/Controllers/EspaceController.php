<?php
namespace App\Http\Controllers;


use App\Http\Requests\StoreEspaceRequest;
use App\Http\Requests\UpdateEspaceRequest;
use App\Models\Espace;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Promotion;
use App\Models\Formateur;
use App\Services\EspaceService;
use Symfony\Component\HttpFoundation\Request;

class EspaceController extends Controller
{
    protected $espaceService;

    public function __construct(EspaceService $espaceService)
    {
        $this->espaceService = $espaceService;
    }

    //Liste des espaces
    public function index()
    {
        
        $espaces = $this->espaceService->getAllEspaces();
        $data = $espaces->map(function($espace) {
            $en_attente = " <span class=\"relative inline-flex items-center gap-x-1 px-3 py-1.5\">

                                <span class=\"relative flex h-2.5 w-2.5 animate-[pulse_1.4s_ease-in-out_infinite] [animation-delay:0ms]\">
                                    <span class=\"inline-flex h-2.5 w-2.5 rounded-full bg-blue-600 opacity-40\"></span>
                                </span>

                                <span class=\"relative flex h-2.5 w-2.5 animate-[pulse_1.4s_ease-in-out_infinite] [animation-delay:200ms]\">
                                    <span class=\"inline-flex h-2.5 w-2.5 rounded-full bg-blue-600 opacity-60\"></span>
                                </span>

                                <span class=\"relative flex h-2.5 w-2.5 animate-[pulse_1.4s_ease-in-out_infinite] [animation-delay:200ms]\">
                                    <span class=\"inline-flex h-2.5 w-2.5 rounded-full bg-blue-600 opacity-80\"></span>
                                </span>

                                <span class=\"relative flex h-2.5 w-2.5 animate-[pulse_1.4s_ease-in-out_infinite] [animation-delay:400ms]\">
                                    <span class=\"inline-flex h-2.5 w-2.5 rounded-full bg-blue-600\"></span>
                                </span>

                            </span>";




            return [
                'id' => $espace->id,
                'first_name' => $espace->nom ?? '',
                'description' => $espace->description ?? '',
                'matière'=>$espace->matiere->libelle,
               'formateur' => $espace->formateur ? $espace->formateur->nom . " " . $espace->formateur->prenom : $en_attente,
                'promotion' => $espace->promotion?->libelle ?? $en_attente,
            ];
        })->toArray();
        return view('adminLayout.espaces.index', compact('data'));
    }
    //Vue pour la création d'un espace
    public function create()
    {
        // On récupère les données nécessaires pour remplir les <select> du formulaire
        $matieres = Matiere::all();
        $promotions = Promotion::all();
        $formateurs = Formateur::all();

        return view('adminLayout.espaces.create', compact('matieres', 'promotions', 'formateurs'));
    }
    //Ajout ou enrregistrement de l'espace
    public function store(StoreEspaceRequest $request)
    {
        try {
            $this->espaceService->createEspace($request->validated());
            return redirect()->route('espaces.index')->with('success', 'Espace créé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création.')->withInput();
        }
    }
    // Voir détails d'un espace spécifique
    public function show(Espace $espace)
    {
        // On utilise le service pour charger les relations (étudiants inscrits, etc.)
        $espaceComplet = $this->espaceService->getEspaceById($espace->id);
        // 1. On récupère les deux collections
       //$etudiantsPromotion = $espaceComplet->promotion?->etudiants ?? collect([]);
        $etudiantsInscrits = $espaceComplet->etudiants;
        //dump($etudiantsPromotion);
        /* 2. On fusionne et on retire les doublons basés sur l'ID
        $tousLesEtudiants = $etudiantsPromotion->merge($etudiantsInscrits)->unique('id');
        */
        // 3. On fait un SEUL map sur la liste finale
        $data = $etudiantsInscrits->map(function($etudiant) {
            return [
                'id'         => $etudiant->id,
                'matricule'  => $etudiant->matricule,
                'nom' => $etudiant->nom,
                'prenom'  => $etudiant->prenom,
                'sexe'=>$etudiant->sexe,
                'email'=>$etudiant->user->email,
                'promotion'=>$etudiant->promotion->libelle,
                'filière'=>$etudiant->filiere_option->option,
            ];
        })->values()->toArray();
        return view('adminLayout.espaces.show', compact('data','espace'));
    }
    //Vue pour ajouter etudiant dans l'espace
    public function addStu(Espace $espace)
    {
        $etudiants=Etudiant::with(['user', 'promotion','filiere_option'])->latest()->get();
        $data = $etudiants->map(function($etudiant) {
            return [
                'id' => $etudiant->id,
                'first_name' => $etudiant->nom,
                'last_name' => $etudiant->prenom,
                'matricule'=>$etudiant->matricule,
                'email' => $etudiant->user->email,
                'sexe'=>$etudiant->sexe,
                'promotion' => $etudiant->promotion?->libelle ?? '',
                'filiere_option' => $etudiant->filiere_option?->option ?? '',
            ];
        })->toArray();
         return view('adminLayout.espaces.addStu', compact('espace','data'));
    }


    //Ajouter etudiant dans l'espace
    public function inscrireEtudiant(Request $request, $espaceId)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id'
        ]);

        $result = $this->espaceService->ajoutEtudiant($espaceId, $request->etudiant_id);

        if ($result) {
            return back()->with('success-etu-add', 'L\'étudiant a été ajouté à l\'espace !');
        }

        return back()->with('info-etu-add', 'Cet étudiant est déjà inscrit dans cet espace.');
    }


    public function retireEtudiant(Request $request, $espaceId)
    {
        // On peut aussi passer l'ID de l'étudiant directement dans l'URL si on préfère
        $etudiantId = $request->input('etudiant_id');

        try {
            $this->espaceService->retireEtudiant($espaceId, $etudiantId);
            
            return back()->with('success-etu-reti', 'L\'étudiant a été retiré de cet espace.');
        } catch (\Exception $e) {
            return back()->with('error-etu-reti', 'Une erreur est survenue lors du retrait.');
        }
    }

    //Vue pour éditer un espace
    public function edit(Espace $espace)
    {
        $matiered = Matiere::all();
        $promotiond = Promotion::all();
        $formateurd = Formateur::all();

        $matieres = $matiered->map(function($matiered) {
            return [
                'id' => $matiered->id,
                'libelle' => $matiered->libelle?? '',
            ];
        })->toArray();

        $promotions = $promotiond->map(function($promotiond) {
            return [
                'id' => $promotiond->id,
                'libelle' => $promotiond->libelle?? '',
            ];
        })->toArray();

        $formateurs = $formateurd->map(function($formateurd) {
            return [
                'id' => $formateurd->id,
                'NomPrenom' => $formateurd->nom." ".$formateurd->prenom?? '',
            ];
        })->toArray();
        


        return view('adminLayout.espaces.edit', compact('espace', 'matieres', 'promotions', 'formateurs'));
    }

    //Édition d'un espace
    public function update(UpdateEspaceRequest $request, Espace $espace)
    {
        try {
            $this->espaceService->updateEspace($espace->id, $request->validated());
            return redirect()->route('espaces.index')->with('status_update', 'Espace mis à jour.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur de mise à jour.');
        }
    }
    //Suppression d'un espace
    public function destroy(Espace $espace)
    {
        try {
            $this->espaceService->deleteEspace($espace->id);
            return redirect()->route('espaces.index')->with('status_delete', 'Espace supprimé.');
        } catch (\Exception $e) {
            return back()->with('error', 'Impossible de supprimer cet espace.');
        }
    }
}