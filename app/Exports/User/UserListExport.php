<?php

namespace App\Exports\User;

use App\Actions\Users\ListUserAction;
use App\Enums\RoleEnum;
use App\Exports\ArrayExport;
use App\Helpers\ConvertToDate;
use App\Models\User;

class UserListExport extends ListUserAction
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function Export()
    {
        $export = User::when(fn ($query) => $this->whereName($query))
            ->when(fn ($query) => $this->whereCpf($query))
            ->when(fn ($query) => $this->whereEmail($query))
            ->when(fn ($query) => $this->whereRole($query))
            ->get();


        $exportArray = [];
        foreach ($export as $key => $value) {
            array_push($exportArray, [
                'Nome' => $value->name,
                'CPF' => $value->cpf,
                'E-mail' => $value->email,
                // 'Permissão' => isset($value->role) ? $value->role->role : '',
                'Ativo' => $value->active ? 'Sim' : 'Não',
                'Data de Criação' => ConvertToDate::toDateTime($value->created_at),
            ]);
        }

        return new ArrayExport($exportArray);
    }
}
