<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdministrationRequest;
use App\Http\Requests\UpdateAdministrationRequest;
use App\Models\Administration;
use App\Services\AdministrationService;
use App\Models\User;

class AdministrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $service = new AdministrationService();
        $admins = $service->getAllAdministrations();
        $data = $admins->map(function($a) {
            return [
                'id' => $a->id,
                'nom' => $a->nom,
                'prenom' => $a->prenom,
                'email' => $a->user->email ?? '',
                'fonction' => $a->fonction ?? '',
            ];
        })->toArray();

        return view('adminLayout.administrations.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminLayout.administrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdministrationRequest $request)
    {
        try {
            $service = new AdministrationService();
            $admin = $service->createAdministration($request->validated());
            return redirect()->route('administrations.index')->with('success-admin-store', "Le membre {$admin->prenom} a été créé et ses accès envoyés.");
        } catch (\Exception $e) {
            return back()->withInput()->with('error-admin-store', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Administration $administration)
    {
        return view('adminLayout.administrations.show', compact('administration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administration $administration)
    {
        return view('adminLayout.administrations.edit', compact('administration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministrationRequest $request, Administration $administration)
    {
        try {
            $service = new AdministrationService();
            $updated = $service->updateAdministration($administration->id, $request->validated());
            return redirect()->route('administrations.index')->with('success-admin-store', "Le membre {$updated->prenom} a été mis à jour.");
        } catch (\Exception $e) {
            return back()->withInput()->with('error-admin-store', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administration $administration)
    {
        try {
            $service = new AdministrationService();
            $service->deleteAdministration($administration->id);
            return redirect()->route('administrations.index')->with('success-admin-store', "Le membre {$administration->prenom} a été supprimé.");
        } catch (\Exception $e) {
            return back()->with('error-admin-store', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    /**
     * Envoi manuel des accès au membre de l'administration
     */
    public function sendCredentials(Administration $administration)
    {
        try {
            $service = new AdministrationService();
            $service->sendCredentials($administration->id);
            return redirect()->route('administrations.index')->with('success-admin-store', "Les accès ont été envoyés à {$administration->prenom}.");
        } catch (\Exception $e) {
            return back()->with('error-admin-store', 'Erreur lors de l\'envoi des accès : ' . $e->getMessage());
        }
    }
}
