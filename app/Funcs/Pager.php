<?php

namespace App\Funcs;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class Pager
{
    private int $total;
    private int $pageSize;
    private int $lastPage;
    private int $currentPage;

    public function __construct($total, $pageSize)
    {
        $this->total = $total;
        $this->pageSize = $pageSize;
        if ($total <= $pageSize) {
            $this->lastPage = 1;
        } else {
            $this->lastPage = ceil($this->total / $this->pageSize);
        }
        $this->currentPage = request()->get('page', 1);
    }

    public static function new($total, $pageSize): Pager
    {
        return new Pager($total, $pageSize);
    }

    public static function paginate(Collection $items, $perPage): LengthAwarePaginator
    {
        if (isset($_GET['page']))
            $page = $_GET['page'];
        else
            $page = 1;
        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            Paginator::resolveCurrentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getCurrentPage(): mixed
    {
        return $this->currentPage;
    }

    public function getFrom(): int
    {
        return (($this->currentPage - 1) * $this->pageSize) + 1;
    }

    public function getTo(): int
    {
        if ($this->currentPage !== $this->getLastPage()) {
            return $this->currentPage * $this->pageSize;
        } else {
            return $this->total;
        }
    }

    public function getLastPage(): int
    {
        return $this->lastPage;
    }

}
