<?php

use Illuminate\Database\Seeder;
use App\Repositories\CustomerRepositoryInterface;

class CustomersTableSeeder extends Seeder
{
    protected $repository;

    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            \App\Customer::create([
                'code'		  => $this->repository->generateCode('CUSTOMER'),
                'first_name'            => 'KASSANDRA ' . $i,
                'last_name'             => 'WILDES ' . $i,
                'phone'                 => '090000000'.$i,
                'company'               => 'Company ' . $i,
                'email'                 => 'email@gmail.com',
                'street_address_line_1' => 'address ' . $i,
                'street_address_line_2' => 'address ' . $i,
                'street_address_line_3' => 'address ' . $i,
                'city'                  => 'City ' . $i,
                'state'                 => 'State ' . $i,
                'zip'                   => 'Zip ' . $i,
                'birthday'              => null,
                'note'                  => 'Note ' . $i,
                'active'                => true
            ]);
        }
    }
}
