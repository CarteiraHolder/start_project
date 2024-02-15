<?php

namespace App\Http\Controllers\Setting;

use App\Actions\Setting\UpdateSettingAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingsRequest;
use Illuminate\Http\Response;

class UpdateSettinsController extends Controller
{
    public function __invoke(UpdateSettingsRequest $request): Response
    {
        if ($request->user()->email != 'fhstefanutto@gmail.com') {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        $clearAllCache = false;
        if ($request->clearAllCache == 'true')
            $clearAllCache = true;

        return Response(
            [
                'message' => 'Configurações atualizadas com sucesso',
                'data' => (new UpdateSettingAction)
                    ->setApiGeolocation($request->apiGeolocation)
                    ->setClearAllCache($clearAllCache)
                    ->setClearLogUserActions($request->clearLogUserActions)
                    ->handle()
            ]


        );
    }
}
