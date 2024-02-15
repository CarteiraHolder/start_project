<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\TokenGenerationUserAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Jobs\Logs\LogLoginBecomeJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginBecomeUserController extends Controller
{
    public function __invoke(Request $request, int $id): Response
    {

        if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        LogLoginBecomeJob::dispatch(user: $request->user(), userBecomeId: $id);

        $userBecome = Auth::guard('web')->loginUsingId($id);

        $token = (new TokenGenerationUserAction)
            ->setUser($userBecome)
            ->setTokenName(env("APP_NAME", 'Laravel') . 'Becone')
            ->setDeleteToken(false)
            ->handle();

        return Response([
            'message' => '',
            'token' => $token
        ], 200);
    }
}
