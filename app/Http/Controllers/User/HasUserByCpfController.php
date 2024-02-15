<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\HasUserByCpfAction;
use App\Http\Controllers\Controller;

class HasUserByCpfController extends Controller
{
    public function __invoke(string $cpf)
    {
        $user = (new HasUserByCpfAction)->handle($cpf);

        return response([
            'data' => isset($user->id),
        ]);
    }
}
