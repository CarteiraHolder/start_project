<?php

namespace App\Http\Controllers\Notification;

use App\Actions\Notification\FindMyNotificationsAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AllNotifyController extends Controller
{
    public function __invoke(): Response
    {
        $CollectionNotification = (new FindMyNotificationsAction)->handle();

        foreach ($CollectionNotification as $key => $value) {
            $value->has_open = true;
            $value->save();
        }

        return response([
            'data' => $CollectionNotification
        ]);
    }
}
