<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CategoryRepositoryInterface;
use App\Category;

class CategoryEloquentRepository extends BaseEloquentRepository implements CategoryRepositoryInterface
{
    /* ===== INIT MODEL ===== */
    protected function setModel()
    {
        $this->model = Category::class;
    }

    /* ===== PUBLIC FUNCTION ===== */
}