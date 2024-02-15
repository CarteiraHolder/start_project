<?php

namespace App\Http\Controllers\Address;

use App\Actions\Address\FindCitiesAction;
use App\Apis\BrasilApi\CepApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class FindByCep extends Controller
{
    public function __invoke(?string $cep = null): Response
    {
        if (!isset($cep) || Str::length($cep) != 8)
            return response(['message' => 'Endereço não encontrado'], 403);

        $Adrress = (new CepApi)->handle($cep);
        $Adrress['city'] = (new FindCitiesAction)->handle($Adrress['city'] ?? "", $Adrress['state'] ?? "");

        return response([
            'message' => 'Endereço encontrado',
            'data' => $Adrress
        ]);
    }
}
