<?php

namespace App\Http\Controllers\ComboBox;

use App\Actions\Brand\ComboBoxBrandAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $collection = (new ComboBoxBrandAction)->handle();

        // if ($collection->count() == 0)
        //     return response(['message' => 'Marca não encontrado'], 403);


        return response([
            'message' => 'Marca encontrado',
            'data' => $collection
        ]);
    }
}
