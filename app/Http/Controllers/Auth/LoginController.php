<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Users\AuthUserAction;
use App\Actions\Users\FindUserByCpfAction;
use App\Actions\Users\TokenGenerationUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Jobs\Logs\LogAuthJob;
use App\Models\User;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __invoke(AuthLoginRequest $request): Response
    {

        $email = (new FindUserByCpfAction)
            ->setCpf($request->cpfOrEmail)
            ->handle()
            ->email
            ?? $request->cpfOrEmail;

        (new AuthUserAction)
            ->setEmail($email)
            ->setPassword($request->password ?? '')
            ->handle();

        if (!$request->user()) {
            return response(['message' => 'Usuário e/ou senha inválida'], 403);
        }

        if ($request->user()->active == false) {
            return response(['message' => 'Seu usuário foi desabilitado'], 403);
        }

        if ($request->user()->contractor && $request->user()->contractor->active == false) {
            return response(['message' => 'Seu usuário foi desabilitado'], 403);
        }

        LogAuthJob::dispatch(
            ip: $request->ip,
            user: $request->user(),
            latitude: $request->latitude,
            longitude: $request->longitude,
            batteryLevel: $request->batteryLevel
        );

        $token = (new TokenGenerationUserAction)
            ->setUser($request->user())
            ->setDeleteToken(true)
            ->handle();

        return response([
            'message' => 'Usuário logado com sucesso',
            'token' => $token
        ], 200);
    }
}
