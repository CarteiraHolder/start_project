<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\ChangePasswordUserAction;
use App\Actions\Users\FindUserByIdAction;
use App\Actions\Users\UpdateProfileUserAction;
use App\Helpers\StorageProfileUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfilePasswordRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfilePasswordController extends Controller
{
    public function __invoke(UpdateUserProfilePasswordRequest $request): Response
    {
        $credentials = [
            'email' => Auth::user()->email ?? '',
            'password' => $request->currencyPassword ?? '',
        ];

        if (!Auth::guard('web')->attempt($credentials)) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        (new ChangePasswordUserAction)
            ->setUser($request->user())
            ->setPassword($request->newPassword)
            ->setNotify(true)
            ->handle();

        return Response([
            'message' => 'Senha atualizado com sucesso',
        ]);
    }
}
