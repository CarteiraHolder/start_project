<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\UpdateUserAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Response;

class UpdateUserController extends Controller
{
    public function __invoke(UpdateUserRequest $request): Response
    {
        if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        (new UpdateUserAction)
            ->setId($request->id)
            ->setName($request->name)
            ->setCpf($request->cpf)
            ->setEmail($request->email)
            ->setRole($request->role)
            ->handle();

        return Response([
            'message' => 'Usuário atualizado',
        ]);
    }
}
