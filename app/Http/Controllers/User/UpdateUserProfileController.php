<?php

namespace App\Http\Controllers\User;

use App\Actions\Users\UpdateProfileUserAction;
use App\Helpers\StorageProfileUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UpdateUserProfileController extends Controller
{
    public function __invoke(Request $request): Response
    {

        $imageName = null;
        if (isset($request->profilePicture))
            $imageName = StorageProfileUser::upload($request->profilePicture);

        (new UpdateProfileUserAction)
            ->setName($request->name)
            ->setProfilePicture($imageName)
            ->handle();

        return Response([
            'message' => 'Dados atualizado com sucesso',
        ]);
    }
}
