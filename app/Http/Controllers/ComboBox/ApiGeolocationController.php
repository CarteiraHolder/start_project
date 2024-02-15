<?php

namespace App\Http\Controllers\ComboBox;

use App\Enums\ApiGeolocationEnum;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiGeolocationController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if ($request->user()->can('hasPermission', RoleEnum::admin)) {
            return response([
                'message' => 'APIs encontrado',
                'apis' => ApiGeolocationEnum::cases()
            ]);
        }



        return Response(['message' => "Você não tem permissão para essa ação"], 403);
    }
}
