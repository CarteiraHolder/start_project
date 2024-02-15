<?php

namespace App\Http\Controllers\ComboBox;

use App\Actions\Industry\ComboBoxIndustryAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class IndustryController extends Controller
{
    public function __invoke(): Response
    {
        $collection = (new ComboBoxIndustryAction)->handle();

        // if ($collection->count() == 0)
        //     return response(['message' => 'Industria não encontrado'], 403);


        return response([
            'message' => 'Industria encontrado',
            'data' => $collection
        ]);
    }
}
