<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\FindUserByIdAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FindUserByIdController extends Controller
{
    public function __invoke(Request $request, int $id): Response
    {
        if (
            $request->user()->cannot('hasPermission', RoleEnum::admin)
            && $request->user()->cannot('hasPermission', RoleEnum::contractorManager)
            && $request->user()->cannot('hasPermission', RoleEnum::contractorAnalyst)
        ) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        $user = (new FindUserByIdAction)
            ->setId($id ?? 0)
            ->handle();


        if (!$user) {
            return Response(['message' => "Usuário não encontrado"], 403);
        }

        return Response([
            'message' => 'Usuário encontrado',
            'data' => $user->only([
                'id',
                'name',
                'cpf',
                'email',
                'created_at',
                'profile_photo',
                'active',
                'role',
                'flag',
                'industry',
                'contractor',
            ])
        ]);
    }
}
