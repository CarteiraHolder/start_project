<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\ChangePasswordUserAction;
use App\Actions\Users\FindUserByHashAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewPasswordUserRequest;
use Illuminate\Http\Response;

class NewPasswordUserController extends Controller
{
    public function __invoke(NewPasswordUserRequest $request): Response
    {
        $user = (new FindUserByHashAction)
            ->setHash($request->hash ?? '')
            ->handle();

        if (!isset($user)) {
            return Response(['message' => "Link de definição de senha inválido"], 403);
        }

        $user = (new ChangePasswordUserAction)
            ->setUser($user)
            ->setPassword($request->password)
            ->setNotify(true)
            ->handle();

        return Response([
            'message' => 'Senha atualiza com sucesso.',
        ]);
    }
}
