<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPasswordUserNotify extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(User $user): MailMessage
    {
        $firstName = explode(' ', $user->name)[0];

        return (new MailMessage)
            ->subject('Senha atualizada')
            ->greeting("Olá, {$firstName}")
            ->line('Sua senha foi definida com sucesso!')
            ->line('Acesso nossa plataforma clicando no botão abaixo')
            ->action('Acessar', url(env('APP_URL')))
            ->salutation('Obrigado, Equipe ' . env("APP_NAME", 'Laravel'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
