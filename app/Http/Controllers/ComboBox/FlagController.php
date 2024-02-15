<?php

namespace App\Http\Controllers\ComboBox;

use App\Actions\Flag\ComboBoxFlagAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FlagController extends Controller
{
    public function __invoke(): Response
    {
        $collectionFlag = (new ComboBoxFlagAction)->handle();

        // if ($collectionFlag->count() == 0)
        //     return response(['message' => 'Bandeira não encontrado'], 403);


        return response([
            'message' => 'Bandeira encontrado',
            'data' => $collectionFlag
        ]);
    }
}
