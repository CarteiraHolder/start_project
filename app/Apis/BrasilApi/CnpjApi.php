<?php

namespace App\Apis\BrasilApi;

use App\Helpers\CharactFirstToUpper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class CnpjApi extends BrasilApi
{
    public function handle(?string $cnpj = ''): Collection
    {
        $response = Http::get($this->setMethod('cnpj')->ApiUrl($cnpj))->json();

        $collection = collect([
            'name' => CharactFirstToUpper::ucFirstAll($response['nome_fantasia']) ?? '',
            'company_name' => CharactFirstToUpper::ucFirstAll($response['razao_social']) ?? '',
            'cep' => $response['cep'] ?? '',
            'address' => CharactFirstToUpper::ucFirstAll($response['logradouro']) ?? '',
            'number' => $response['numero'] ?? '',
            'city' => CharactFirstToUpper::ucFirstAll($response['municipio']) ?? "",
            'state' =>  CharactFirstToUpper::ucFirstAll($response['uf']) ?? "",
            'district' => CharactFirstToUpper::ucFirstAll($response['bairro']) ?? '',
            'complement' =>  CharactFirstToUpper::ucFirstAll($response['complemento']) ?? '',
        ]);

        return $collection;
    }
}
