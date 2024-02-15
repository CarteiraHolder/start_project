<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TestPasswordUserController extends Controller
{
    public function __invoke(?string $password): Response
    {
        $credentials = [
            'email' => Auth::user()->email ?? '',
            'password' => $password ?? '',
        ];

        if (!Auth::guard('web')->attempt($credentials)) {
            return Response(['data' => false]);
        }

        return Response(['data' => true]);
    }
}
