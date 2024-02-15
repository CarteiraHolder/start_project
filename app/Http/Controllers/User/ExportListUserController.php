<?php

namespace App\Http\Controllers\User;

use App\Enums\RoleEnum;
use App\Exports\User\UserListExport;
use App\Http\Controllers\Controller;
use App\Jobs\Export\ExportExcelJob;
use Illuminate\Http\Request;

class ExportListUserController extends Controller
{

    public function __invoke(Request $request)
    {
        if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        $export = (new UserListExport)
            ->setName($request->name)
            ->setCpf($request->cpf)
            ->setEmail($request->email);

        ExportExcelJob::dispatch(
            Export: $export,
            User: $request->user(),
            FileName: 'usuários'
        )->onQueue('big-timeout');

        return Response([
            'message' => 'Estamos preparando seu excel, assim que estiver pronto enviaremos por e-mail'
        ], 200);
    }
}
