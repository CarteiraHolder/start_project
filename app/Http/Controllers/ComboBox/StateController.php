<?php

namespace App\Http\Controllers\ComboBox;

use App\Actions\Address\ComboBoxStateAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StateController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $collectionState = (new ComboBoxStateAction)->handle();

        // if ($collectionState->count() == 0)
        //     return response(['message' => 'Estado não encontrado'], 403);


        return response([
            'message' => 'Estado encontrado',
            'data' => $collectionState
        ]);
    }
}
