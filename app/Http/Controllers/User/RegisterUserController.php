<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\RegisterUserAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\Response;

class RegisterUserController extends Controller
{
    public function __invoke(RegisterUserRequest $request): Response
    {
        if (
            $request->user()->cannot('hasPermission', RoleEnum::admin)
            && $request->user()->cannot('hasPermission', RoleEnum::contractorManager)
            && $request->user()->cannot('hasPermission', RoleEnum::contractorAnalyst)
        ) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        (new RegisterUserAction)
            ->setName($request->name)
            ->setCpf($request->cpf)
            ->setEmail($request->email)
            ->setRole($request->role)
            ->setFlag($request->flag)
            ->setIndustry($request->industry)
            ->setContractor($request->contractor)
            ->handle();

        return Response([
            'message' => 'Usuário casdastrado',
        ]);
    }
}
