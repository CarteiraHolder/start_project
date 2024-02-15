<?php

namespace App\Http\Controllers\Notification;

use App\Actions\Notification\FindMyNotificationsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CountNotifyController extends Controller
{
    public function __invoke(): Response
    {
        return response([
            'count' => (new FindMyNotificationsAction)
                ->setHasOpen(false)
                ->handle()
                ->count()
        ]);
    }
}
