<?php

namespace App\Actions\Users\Trait;

use App\Models\Brand;
use App\Models\Industry;
use Illuminate\Support\Facades\Auth;

trait WhereContractorTrait
{
    protected function whereContractor($query)
    {
        return isset(Auth::user()->contractor->id)
            ? $query->where(
                'users.contractor_id',
                Auth::user()->contractor->id
            )
            : $query;;
    }
}
