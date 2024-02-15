<?php

namespace App\Actions\Users;

use App\Actions\ActionList;
use App\Helpers\RemoveAccentsHelper;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

class ListUserAction extends ActionList
{
    private ?string $name = null;
    private ?string $cpf = null;
    private ?string $email = null;
    private ?string $role = null;
    private ?string $data = null;

    public function  setName(?string $value): self
    {
        $this->name = $value;
        return $this;
    }
    public function  setCpf(?string $value): self
    {
        $this->cpf = preg_replace('/[^A-Za-z0-9]/', '', $value);
        return $this;
    }
    public function  setEmail(?string $value): self
    {
        $this->email = $value;
        return $this;
    }
    public function  setRole(?string $value): self
    {
        $this->role = $value;
        return $this;
    }

    public function handle(): Paginator
    {
        return User::select(
            'id',
            'name',
            'cpf',
            'email',
            'created_at',
            'profile_photo',
            'active',
        )
            ->with('role')
            ->when(fn ($query) => $this->whereName($query))
            ->when(fn ($query) => $this->whereCpf($query))
            ->when(fn ($query) => $this->whereEmail($query))
            ->when(fn ($query) => $this->whereRole($query))
            ->orderBy($this->getSortBy(), $this->sortType)
            ->paginate($this->rowsPerPage, ['*'], 'Users', $this->page);
    }

    //ORDER BY
    protected function getSortBy()
    {
        $sortByExplode = explode('.', $this->sortBy);
        $sortBySelect = $sortByExplode[count($sortByExplode) - 1];

        if (str_contains($this->sortBy, 'role')) {
            return Role::select($sortBySelect)
                ->whereColumn('roles.user_id', 'users.id')
                ->limit(1);
        }

        return $this->sortBy;
    }

    // WHERES
    protected function whereName($query)
    {
        return isset($this->name)
            ? $query->where(
                "name",
                'like',
                "%" . RemoveAccentsHelper::ToClean($this->name) . "%"
            )
            : $query;
    }
    protected function whereCpf($query)
    {
        return isset($this->cpf)
            ? $query->where(
                "cpf",
                'like',
                "%" . $this->cpf . "%"
            )
            : $query;
    }
    protected function whereEmail($query)
    {
        return isset($this->email)
            ? $query->where(
                "email",
                'like',
                "%" . $this->email . "%"
            )
            : $query;
    }
    protected function whereRole($query)
    {
        return isset($this->role)
            ? $query->where(
                Role::select('role')
                    ->whereColumn('roles.user_id', 'users.id')
                    ->limit(1),
                $this->role
            )
            : $query;
    }
}
