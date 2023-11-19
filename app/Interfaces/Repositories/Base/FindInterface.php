<?php

namespace App\Interfaces\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface FindInterface
{
    /**
     * Find Model by id
     *
     * @param int $id
     * @return Model
     */
    public function find(int $id): Model;
}
