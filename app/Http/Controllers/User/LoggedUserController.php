<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoggedUserController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $firstName = explode(' ', $request->user()->name)[0];

        return response([
            'id' => $request->user()->id,
            'name' => $firstName,
            'fullName' => $request->user()->name,
            'email' => $request->user()->email,
            'cpf' => $request->user()->cpf,
            'profilePicture' => $request->user()->profile_photo ?? '/assets/images/profile-picture.jpeg',
            'role' => $request->user()->role->role,
        ]);
    }
}
