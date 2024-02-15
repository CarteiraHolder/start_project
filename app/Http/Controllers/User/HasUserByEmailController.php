<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\HasUserByEmailAction;
use App\Http\Controllers\Controller;

class HasUserByEmailController extends Controller
{
    public function __invoke(string $email)
    {
        $user = (new HasUserByEmailAction)->handle($email);

        return response([
            'data' => isset($user->id),
        ]);
    }
}
