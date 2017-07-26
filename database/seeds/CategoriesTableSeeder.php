<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Category::create([
            'code'        => 'CATEGORY001',
            'name'        => 'Category 1',
            'description' => '',
            'active'      => true
        ]);

        \App\Category::create([
            'code'        => 'CATEGORY002',
            'name'        => 'Category 2',
            'description' => '',
            'active'      => true
        ]);

        \App\Category::create([
            'code'        => 'CATEGORY003',
            'name'        => 'Category 3',
            'description' => '',
            'active'      => true
        ]);
    }
}
