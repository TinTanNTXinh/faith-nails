<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CustomerRepositoryInterface;
use App\Customer;

class CustomerEloquentRepository extends BaseEloquentRepository implements CustomerRepositoryInterface
{
    /* ===== INIT MODEL ===== */
    protected function setModel()
    {
        $this->model = Customer::class;
    }

    /* ===== PUBLIC FUNCTION ===== */
}