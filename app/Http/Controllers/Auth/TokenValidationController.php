<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenValidationController extends Controller
{
    public function __invoke(Request $request): Response
    {
        if (!$request->user()) {
            return response(['status' => 'Unauthorized'], 401);
        }

        if (!$request->user()->active) {
            return response(['status' => 'Unauthorized'], 401);
        }

        if ($request->user()->contractor && $request->user()->contractor->active == false) {
            return response(['status' => 'Unauthorized'], 401);
        }

        return response(['status' => 'Ok'], 200);
    }
}
