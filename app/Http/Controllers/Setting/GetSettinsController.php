<?php

namespace App\Http\Controllers\Setting;

use App\Enums\RoleEnum;
use App\Helpers\FormatBytes;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class GetSettinsController extends Controller
{
    public function __invoke(Request $request): Response
    {

        if ($request->user()->cannot('hasPermission', RoleEnum::admin)) {
            // if ($request->user()->email != 'fhstefanutto@gmail.com') {
            return Response(['message' => "Você não tem permissão para essa ação"], 403);
        }

        $data = [];
        foreach (Storage::disk('local')->allFiles(env("APP_NAME", 'Laravel') . "/") as $key => $value) {
            if ($value == env("APP_NAME", 'Laravel') . '/.DS_Store') continue;

            array_push($data, [
                'size' => FormatBytes::formatBytes(Storage::disk('local')->size($value)),
                'name' => str_replace(env("APP_NAME", 'Laravel') . '/', '', $value)
            ]);
        };


        return Response([
            'settings' => Settings::first(),
            'backups' => $data
        ]);
    }
}
