<?php

namespace App\Actions\Address;

use App\Models\City;

class FindCitiesAction
{

    public function handle(?string $city = '', ?string $uf = '')
    {
        return City::where('name', $city)
            ->where('uf', $uf)
            ->first();
    }
}
