<?php

use Illuminate\Database\Seeder;
use App\Repositories\UserRepositoryInterface;
use App\Common\Helpers\HashHelper;

class AdminsTableSeeder extends Seeder
{
    protected $repository;
    public function __construct(UserRepositoryInterface $repository)
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
        $prefix = 'ADMIN';

        # USER SYSTEM
        // 1
        \App\User::create([
            'code'          => $this->repository->generateCode($prefix),
            'fullname'      => 'Admin',
            'username'      => 'admin',
            'password'      => HashHelper::make('123456'), //t1nt@n50ft.comA1
            'address'       => 'admin',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'admin@admin.com',
            'note'          => 'admin',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
        // 2
        \App\User::create([
            'code'          => $this->repository->generateCode($prefix),
            'fullname'      => 'Super Admin',
            'username'      => 'superadmin',
            'password'      => HashHelper::make('123456'),
            'address'       => '',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => '',
            'note'          => '',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
    }
}
