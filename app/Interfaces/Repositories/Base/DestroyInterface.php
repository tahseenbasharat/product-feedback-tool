<?php

namespace App\Interfaces\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface DestroyInterface
{
    /**
     * Delete resource from database records
     *
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool;
}
