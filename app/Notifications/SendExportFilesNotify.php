<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Maatwebsite\Excel\Excel as BaseExcel;
use Maatwebsite\Excel\Facades\Excel;

class SendExportFilesNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly string $fileName,
        private readonly string $userName,
        private readonly mixed $file
    ) {
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
    public function toMail(object $notifiable): MailMessage
    {
        $firstName = explode(' ', $this->userName)[0];

        $attachment = Excel::raw(
            $this->file,
            BaseExcel::XLSX
        );

        return (new MailMessage)
            ->subject("O relatório de {$this->fileName} está pronto")
            ->greeting("Olá, {$firstName}")
            ->line("Segue em anexo o excel de {$this->fileName}.")
            ->salutation('Obrigado, Equipe ' . env("APP_NAME", 'Laravel'))
            ->attachData(
                $attachment,
                $this->fileName . '.xlsx'
            );
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
