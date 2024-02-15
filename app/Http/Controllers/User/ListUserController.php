<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\ListUserAction;
use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListUserController extends Controller
{

    public function __invoke(Request $request): Response
    {
        if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        $list = (new ListUserAction)
            ->setName($request->name)
            ->setCpf($request->cpf)
            ->setEmail($request->email)
            ->setRole($request->role)
            ->setPage($request->page ?? 1)
            ->setRowsPerPage($request->rowsPerPage ?? 30)
            ->setSortBy($request->sortBy ?? "name")
            ->setSortType($request->sortType ?? "asc")
            ->handle();

        return Response(['list' => $list]);
    }
}
