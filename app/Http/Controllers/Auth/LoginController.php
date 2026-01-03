<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Afficher le formulaire
    public function showLoginForm() {
        return view('auth.login');
    }

    // Gérer la tentative de connexion
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Vérification si le compte est actif
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Votre compte est désactivé.']);
            }

            // Redirection selon le rôle
            return match($user->role) {
                'admin'     => redirect()->intended('/admin')->with('success-login','Connexion réussie'),
                'formateur' => redirect()->intended('/formateur')->with('success-login','Connexion réussie'),
                'etudiant'  => redirect()->intended('/etudiant')->with('success-login','Connexion réussie'),
                default     => redirect('/'),
            };
        }

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ])->onlyInput('email');
    }

    // Déconnexion
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}