<?php


namespace App\Interfaces\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface StoreInterface
{
    /**
     * Create new entry into database records
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;
}
