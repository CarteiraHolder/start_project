<?php

namespace App\Http\Controllers\ComboBox;

use App\Actions\Address\ComboBoxCityAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if (!isset($request->state))
            return response(['message' => 'Cidade não encontrado'], 403);


        $collectionCity = (new ComboBoxCityAction)->handle($request->state);

        // if ($collectionCity->count() == 0)
        //     return response(['message' => 'Cidade não encontrado'], 403);


        return response([
            'message' => 'Cidade encontrado',
            'data' => $collectionCity
        ]);
    }
}
