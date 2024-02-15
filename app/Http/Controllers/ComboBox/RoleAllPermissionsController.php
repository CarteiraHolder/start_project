<?php

namespace App\Http\Controllers\ComboBox;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleAllPermissionsController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if ($request->user()->can('hasPermission', RoleEnum::admin)) {
            return response([
                'message' => 'Permissão encontrado',
                'roles' => RoleEnum::cases()
            ]);
        }

        response([
            'message' => 'Permissão não encontrado',
            'roles' => []
        ]);
    }
}
