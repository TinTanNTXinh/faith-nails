<?php

namespace App\Repositories\Eloquent;

use App\Item;
use App\Repositories\ItemRepositoryInterface;

class ItemEloquentRepository extends BaseEloquentRepository implements ItemRepositoryInterface
{
    /* ===== INIT MODEL ===== */
    protected function setModel()
    {
        $this->model = Item::class;
    }

    public function findAllActiveSkeleton()
    {
        return $this->getModel()
            ->where('items.active', true)
            ->leftJoin('categories', 'categories.id', '=', 'items.category_id')
            ->select('items.*', 'categories.name as category_name')
            ->get();
    }

    /* ===== PUBLIC FUNCTION ===== */

}