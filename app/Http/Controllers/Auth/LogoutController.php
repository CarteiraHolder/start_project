<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Users\LogoutUserAction;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function __invoke(Request $request): Response
    {
        (new LogoutUserAction)->handle(user: $request->user());

        return response([
            'message' => 'Usuário deslogado com sucesso',
        ]);
    }
}
