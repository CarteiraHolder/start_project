<?php

namespace App\Http\Controllers\ComboBox;

use App\Actions\Contractor\ComboBoxContractorAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ContractorController extends Controller
{
    public function __invoke(): Response
    {
        $collectionContractor = (new ComboBoxContractorAction)->handle();

        // if ($collectionContractor->count() == 0)
        //     return response(['message' => 'Contratante não encontrado'], 403);


        return response([
            'message' => 'Contratante encontrado',
            'data' => $collectionContractor
        ]);
    }
}
