<?php

namespace App\Http\Controllers\ComboBox;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if ($request->user()->can('hasPermission', RoleEnum::admin)) {
            return response([
                'message' => 'Permissão encontrado',
                'roles' => [
                    RoleEnum::admin,
                    RoleEnum::user,
                ]
            ]);
        }

        response([
            'message' => 'Permissão não encontrado',
            'roles' => []
        ]);
    }
}
