<?php

namespace App\Apis\BrasilApi;

use Illuminate\Support\Facades\Http;

class CepApi extends BrasilApi
{
    public function handle(?int $zipCode = 0)
    {
        $response = Http::get($this->setVersion('v2')->setMethod('cep')->ApiUrl($zipCode))->json();

        $collection = collect([
            'address' => $response['street'] ?? '',
            'city' => $response['city'] ?? "",
            'state' =>  $response['state'] ?? "",
            'district' => $response['neighborhood'] ?? '',
            'complement' => '',
            'longitude' => $response['location']['coordinates']['longitude'] ?? '',
            'latitude' => $response['location']['coordinates']['latitude'] ?? '',
        ]);

        return $collection;
    }
}
