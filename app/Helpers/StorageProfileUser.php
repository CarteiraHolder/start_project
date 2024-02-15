<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Decoders\DataUriImageDecoder;
use Intervention\Image\Decoders\Base64ImageDecoder;
use Intervention\Image\Encoders\WebpEncoder;

class StorageProfileUser
{

    static public function upload(string $image_64): string
    {
        $userId = Auth::user()->id;
        $folder =  "users/{$userId}/profile/";

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);

        $imageName = $folder . md5(date("Y-m-d H:i:s")) . '.' . $extension;

        $manager = new ImageManager(new Driver());
        $img = $manager->read($image, [
            DataUriImageDecoder::class,
            Base64ImageDecoder::class,
        ]);

        $img->scale(150, 150);

        Storage::disk('public')
            ->put(
                $imageName,
                $img->encode(new WebpEncoder())
                // $img->encode(new WebpEncoder(quality: 50))
            );

        $allFiles = Storage::disk('public')->allFiles($folder);

        foreach ($allFiles as $key => $value) {
            if ($value == $imageName) continue;

            Storage::disk('public')->delete($value);
        }

        $location = "/storage/{$imageName}";

        return $location;
    }
}
