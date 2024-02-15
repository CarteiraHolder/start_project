<?php

namespace App\Actions;


class ActionList
{
    protected int $page = 1;
    protected int $rowsPerPage = 30;
    protected string $sortBy = 'name';
    protected string $sortType = 'asc';

    public function setPage(int $value)
    {
        $this->page = $value;
        return $this;
    }

    public function setRowsPerPage(int $value)
    {
        $this->rowsPerPage = $value;
        return $this;
    }

    public function setSortBy(string $value)
    {
        $this->sortBy = $value == 'null' ? $this->sortBy : $value;
        return $this;
    }

    public function setSortType(string $value)
    {
        $this->sortType = $value == 'null' ? $this->sortType : $value;
        return $this;
    }

    public function handle()
    {
    }
}
