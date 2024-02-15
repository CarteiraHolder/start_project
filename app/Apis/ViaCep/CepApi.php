<?php

namespace App\Apis\ViaCep;

use App\Actions\Address\FindCitiesAction;
use Illuminate\Support\Facades\Http;

class CepApi
{
    public function handle(?int $zipCode = 0)
    {
        $response = Http::get("https://viacep.com.br/ws/{$zipCode}/json/");
        $json = json_decode($response->body());

        $collection = collect([
            'address' => $json->logradouro ?? '',
            'city' => (new FindCitiesAction)->handle($json->localidade ?? "", $json->uf ?? ""),
            'district' => $json->bairro ?? '',
            'complement' => $json->complemento ?? '',
        ]);

        return $collection;
    }
}
