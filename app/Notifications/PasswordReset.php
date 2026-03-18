<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;

    public function __construct(public string $token)
    {
    }

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Vous recevez cet email car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.')
            ->action('Réinitialiser le mot de passe', url('password/reset', $this->token))
            ->line("Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune autre action n'est requise.");
    }

    public function toArray(mixed $notifiable): array
    {
        return [];
    }
}
