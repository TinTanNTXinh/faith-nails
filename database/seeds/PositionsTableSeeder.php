<?php

use Illuminate\Database\Seeder;
use App\Repositories\PositionRepositoryInterface;

class PositionsTableSeeder extends Seeder
{
    protected $repository;
    public function __construct(PositionRepositoryInterface $repository)
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
        $array_name = [
            'Admin',
            'Employee',
            'Owner'
        ];
        foreach($array_name as $key => $name){
            \App\Position::create([
            	'code'		  => $this->repository->generateCode('POSITION'),
                'name'        => $array_name[$key],
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
