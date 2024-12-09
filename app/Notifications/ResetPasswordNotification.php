<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecer Contraseña')
            ->greeting('Hola,')
            ->line('Recibiste este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.')
            ->action('Restablecer Contraseña', url('password/reset', $this->token))
            ->line('Si no solicitaste el restablecimiento, ignora este mensaje.')
            ->salutation('Saludos, ' . config('app.name'));
    }
}

