<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChangedNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Tu contraseña fue actualizada - Fastkart')
            ->greeting('Hola ' . $notifiable->name . ' 👋')
            ->line('Te informamos que la contraseña de tu cuenta fue cambiada correctamente.')
            ->line('Si tú no realizaste este cambio, por favor contacta con soporte inmediatamente.')
            ->action('Ir a Fastkart', url('/'))
            ->salutation('Saludos, Fastkart');
    }
}
