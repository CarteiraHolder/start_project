<?php

namespace App\Actions\Address;

use Illuminate\Database\Eloquent\Collection;
use App\Models\City;
use App\Helpers\RemoveAccentsHelper;
use Illuminate\Support\Facades\Cache;

class ComboBoxCityAction
{

    public function handle(?string  $uf = null): Collection
    {
        return Cache::rememberForever(
            "city.{$uf}",
            fn () =>
            City::select('id', 'name', 'uf')
                ->where('uf', $uf)
                ->orderBy('name')
                ->get()
        );
    }
}
