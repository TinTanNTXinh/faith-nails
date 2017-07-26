<?php

use Illuminate\Database\Seeder;
use App\Repositories\RoleRepositoryInterface;

class RolesTableSeeder extends Seeder
{
    protected $repository;
    public function __construct(RoleRepositoryInterface $repository)
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
            'Dashboard', // 1
            'Employees', // 2
            'Customers', // 3
            'Appointments', // 4
            'Categories', // 5
            'Items', // 6
            'Marketing', // 7
            'Reports', // 8
            'Positions', // 9
        ];

        $array_description = [
            'Dashboard',
            'Employee',
            'Customer',
            'Appointment',
            'Category',
            'Item',
            'Marketing',
            'Report',
            'Position',
        ];

        $array_router_link = [
            '/dashboard',
            '/employees',
            '/customers',
            '/appointment',
            '/categories',
            '/items',
            '/marketing',
            '/reports',
            '/positions',
        ];

        $array_group_id = [
            1,
            1,
            1,
            1,
            2,
            2,
            1,
            1,
            1
        ];

        $array_index = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
        ];

        $array_icon_name = [
            'dashboard',
            'palette',
            'person',
            'settings_application',
            'fiber_manual_record',
            'list',
            'desktop_mac',
            'palette',
            'palette',

        ];

        foreach ($array_name as $key => $name) {
            \App\Role::create([
                'code'          => $this->repository->generateCode('ROLE'),
                'name'          => $name,
                'description'   => $array_description[$key],
                'router_link'   => $array_router_link[$key],
                'icon_name'     => $array_icon_name[$key],
                'index'         => $array_index[$key],
                'group_role_id' => $array_group_id[$key],
                'active'        => true
            ]);
        }
    }
}
