<?php

namespace App\Interfaces\Repositories\Base;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateInterface
{
    /**
     * return paginated results
     *
     * @return LengthAwarePaginator
     */
    public function paginatedList(): LengthAwarePaginator;
}
