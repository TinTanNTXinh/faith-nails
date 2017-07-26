<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FileRepositoryInterface;
use App\File;

class FileEloquentRepository extends BaseEloquentRepository implements FileRepositoryInterface
{
    /* ===== INIT MODEL ===== */
    protected function setModel()
    {
        $this->model = File::class;
    }

    /* ===== PUBLIC FUNCTION ===== */
}