<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPasswordUserNotify extends Notification implements ShouldQueue
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
        $link = base64_encode(md5($user->id) . "|" . md5($user->email) . "|" . md5($user->password));

        return (new MailMessage)
            ->subject('Recuperação de senha')
            ->greeting("Olá, {$firstName}")
            ->line('Clique no botão abaixo para defenir sua nova senha')
            ->action('Cadastrar senha', url(env('APP_URL') . "/nova-senha/{$link}"))
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
