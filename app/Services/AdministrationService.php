<?php

namespace App\Services;

use App\Models\User;
use App\Models\Administration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\WelcomeAdministrationNotification;

class AdministrationService
{
    public function getAllAdministrations()
    {
        return Administration::with('user')->latest()->get();
    }

    public function getAdministrationById($id)
    {
        return Administration::with('user')->findOrFail($id);
    }

    public function createAdministration(array $data)
    {
        return DB::transaction(function () use ($data) {
            $temporaryPassword = Str::random(10);

            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($temporaryPassword),
                'role' => 'admin',
                'is_active' => $data['is_active'] ?? true,
            ]);

            $administration = $user->administration()->create([
                'nom' => $data['nom'] ?? null,
                'prenom' => $data['prenom'] ?? null,
                'fonction' => $data['fonction'] ?? null,
            ]);

            try {
                $user->notify(new WelcomeAdministrationNotification($temporaryPassword));
            } catch (\Exception $e) {
                // Don't rollback on email failure
            }

            return $administration;
        });
    }

    public function updateAdministration($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $administration = Administration::findOrFail($id);
            $user = $administration->user;

            if (!empty($data['email'])) {
                $user->update(['email' => $data['email']]);
            }

            if (!empty($data['password'])) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

            $administration->update($data);

            return $administration->fresh();
        });
    }

    public function deleteAdministration($id)
    {
        return DB::transaction(function () use ($id) {
            $administration = Administration::findOrFail($id);
            $user = $administration->user;

            $administration->delete();
            $user->delete();

            return true;
        });
    }

    public function sendCredentials($id)
    {
        return DB::transaction(function () use ($id) {
            $administration = Administration::findOrFail($id);
            $user = $administration->user;

            $temporaryPassword = Str::random(10);
            $user->update(['password' => Hash::make($temporaryPassword)]);
            $user->notify(new WelcomeAdministrationNotification($temporaryPassword));

            return true;
        });
    }
}
