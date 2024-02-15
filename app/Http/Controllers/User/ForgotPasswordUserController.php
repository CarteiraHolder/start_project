<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\FindUserByEmailAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordUserRequest;
use App\Notifications\ForgotPasswordUserNotify;
use Illuminate\Http\Response;

class ForgotPasswordUserController extends Controller
{
    public function __invoke(ForgotPasswordUserRequest $request): Response
    {

        $user = (new FindUserByEmailAction)
            ->setEmail($request->email)
            ->handle();

        if (isset($user))
            $user->notify(new ForgotPasswordUserNotify);

        return Response([
            'message' => "Enviamos um e-mail para {$request->email}, com o link de recuperação de senha.",
        ]);
    }
}
