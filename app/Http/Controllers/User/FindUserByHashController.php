<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\FindUserByHashAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FindUserByHashController extends Controller
{
    public function __invoke(Request $request, ?string $hash): Response
    {
        if (!isset($hash)) {
            return Response(['message' => "Link de definição de senha inválido"], 401);
        }

        $user = (new FindUserByHashAction)
            ->setHash($hash ?? '')
            ->handle();

        if (!isset($user)) {
            return Response(['message' => "Link de definição de senha inválido"], 401);
        }

        return Response([
            'message' => 'Usuário encontrado',
            'data' => [
                'name' => explode(' ', $user->name)[0]
            ]
        ]);
    }
}
