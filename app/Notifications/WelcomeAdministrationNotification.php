<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeAdministrationNotification extends Notification
{
    use Queueable;

    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $firstName = $notifiable->administration->prenom ?? '';

        return (new MailMessage)
            ->subject('Bienvenue sur NomPlatform - Vos accès')
            ->greeting('Bonjour ' . ($firstName ?: ''))
            ->line('Votre compte administrateur a été créé par le système.')
            ->line('Vous pouvez désormais vous connecter avec les identifiants suivants :')
            ->line('**Email :** ' . $notifiable->email)
            ->line('**Mot de passe provisoire :** ' . $this->password)
            ->action('Se connecter à mon espace', url('/login'))
            ->line('Nous vous conseillons de changer votre mot de passe après votre première connexion.');
    }
}
