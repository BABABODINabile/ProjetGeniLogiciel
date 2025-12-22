<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = ['email', 'password', 'role', 'is_active'];

    protected $hidden = ['password', 'remember_token'];

    // Accès au profil étudiant
    public function etudiant(): HasOne
    {
        return $this->hasOne(Etudiant::class);
    }

    // Accès au profil formateur
    public function formateur(): HasOne
    {
        return $this->hasOne(Formateur::class);
    }

    // Accès au profil administration
    public function administration(): HasOne
    {
        return $this->hasOne(Administration::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
