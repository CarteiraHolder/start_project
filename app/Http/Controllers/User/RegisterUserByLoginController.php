<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\RegisterUserAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserByLoginRequest;
use Illuminate\Http\Response;


class RegisterUserByLoginController extends Controller
{
    public function __invoke(RegisterUserByLoginRequest $request): Response
    {

        (new RegisterUserAction)
            ->setName($request->name)
            ->setEmail($request->email)
            ->setRole(RoleEnum::user->value)
            ->handle();

        return Response([
            'message' => "Enviamos um e-mail para você criar sua senha",
        ]);
    }
}
