<?php

namespace App\Jobs\Email;

use App\Mail\DevErrorMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EmailGoogleGeolocationApiMultResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly object $GoogleGeolocationApi)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('fhstefanutto@gmail.com')
            ->send(
                new DevErrorMail(
                    msg: "Na API GoogleGeolocationApi ao buscar uma geolocalização foi encontrado " . count($this->GoogleGeolocationApi->results) . " resultados, sendo assim é possivel que a geolocalização não seja precisa",
                    data: json_encode($this->GoogleGeolocationApi->results)
                )
            );
    }
}
