<?php

namespace App\Actions\Address;

use Illuminate\Database\Eloquent\Collection;
use App\Models\City;
use App\Helpers\RemoveAccentsHelper;
use Illuminate\Support\Facades\Cache;

class ComboBoxStateAction
{

    public function handle(): Collection
    {
        return Cache::rememberForever(
            'state',
            fn () =>
            City::select('state', 'uf')
                ->groupBy('state', 'uf')
                ->orderBy('state')
                ->get()
        );
    }
}
