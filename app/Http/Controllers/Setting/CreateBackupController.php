<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Jobs\Backup\CreateBackupJob;
use Illuminate\Http\Request;

class CreateBackupController extends Controller
{
    public function __invoke(Request $request)
    {
        // if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
        if ($request->user()->email != 'fhstefanutto@gmail.com') {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        CreateBackupJob::dispatch($request->user())->onQueue('big-timeout');

        return Response([
            'message' => 'O backup está sendo processado, assim que terminar enviaremos uma notificação.',
        ]);
    }
}
