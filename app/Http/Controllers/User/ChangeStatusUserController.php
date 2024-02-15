<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\ChangeStatusUserAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChangeStatusUserController extends Controller
{
    public function __invoke(Request $request, int $id): Response
    {
        if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        $User = (new ChangeStatusUserAction)->setId($id)->handle();


        return Response([
            'message' => $User->name . " foi " . ($User->active ? 'ativado' : 'desativado')
        ], 200);
    }
}
