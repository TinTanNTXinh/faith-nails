<?php

use App\Repositories\ItemRepositoryInterface;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $repository;
//    protected $repository;
//    public function __construct(PositionRepositoryInterface $repository)
//    {
//        $this->repository = $repository;
//    }
    public function __construct(ItemRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        for ($i = 1; $i < 4; $i++) {
            \App\Item::create([
                'code'         => $this->repository->generateCode('ITEM'),
                'category_id'  => $i,
                'product_code' => 'PDC00' . $i,
                'sku'          => 'SKU ' . $i,
                'price'        => 100000,
                'commission'   => 100000,
                'name'         => 'San pham ' . $i,
                'note'         => 'Note ' . $i,
                'active'       => true
            ]);
        }
    }
}
