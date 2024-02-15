<?php

namespace App\Http\Controllers\Notification;

use App\Actions\Notification\DeleteByIdNotifyAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class DeleteByIdNotifyController extends Controller
{
    public function __invoke(int $id): Response
    {
        (new DeleteByIdNotifyAction())->handle(id: $id);

        return Response([
            'message' => 'Notificação excluida'
        ]);
    }
}
