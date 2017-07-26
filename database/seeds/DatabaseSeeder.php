<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $env = env('APP_PROD', false);
        if ($env) {
            /*
             * ===== DEFAULT =====
             * */

            # Nhóm người dùng
            $this->call(GroupRolesTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(PositionsTableSeeder::class);
            $this->call(AdminsTableSeeder::class);
            $this->call(AdminRolesTableSeeder::class);
            $this->call(AdminPositionsTableSeeder::class);
            $this->call(AdminFieldsTableSeeder::class);

            $this->call(UsersTableSeeder::class);
            $this->call(UserRolesTableSeeder::class);
            $this->call(UserPositionsTableSeeder::class);
            $this->call(AdminFieldsTableSeeder::class);
            $this->call(FieldsTableSeeder::class);
            $this->call(ItemsTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
            $this->call(CustomersTableSeeder::class);

            # Nhóm Xe - Tai xe - Chi phi phat sinh
            // $this->call(TrucksTableSeeder::class);
            // $this->call(GaragesTableSeeder::class);
            // $this->call(DriversTableSeeder::class);
            // $this->call(DriverTrucksTableSeeder::class);
            // $this->call(CostsTableSeeder::class);

            # Nhóm sản phẩm
            // $this->call(ProductsTableSeeder::class);
            // $this->call(ProductCodesTableSeeder::class);

            # Nhóm linh tinh
            $this->call(AdminFilesTableSeeder::class);

            # Nhóm Khách hàng - Nhien lieu
            // $this->call(CustomersTableSeeder::class);
            // $this->call(StaffCustomersTableSeeder::class);
            // $this->call(FuelCustomersTableSeeder::class);

            # Nhom Don hang - Cuoc phi
            $this->call(UnitsTableSeeder::class);
            // $this->call(PostagesTableSeeder::class);
            // $this->call(FormulasTableSeeder::class);
            // $this->call(TransportsTableSeeder::class);
            // $this->call(TransportFormulasTableSeeder::class);
            // $this->call(TransportInvoicesTableSeeder::class);
            // $this->call(TransportVouchersTableSeeder::class);
            // $this->call(InvoicesTableSeeder::class);
            // $this->call(InvoiceDetailsTableSeeder::class);

        } else {
            /*
             * ===== DEVELOP =====
             * */

            # Nhóm người dùng
            $this->call(GroupRolesTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(PositionsTableSeeder::class);
            $this->call(AdminsTableSeeder::class);
            $this->call(AdminRolesTableSeeder::class);
            $this->call(AdminPositionsTableSeeder::class);
            $this->call(AdminFieldsTableSeeder::class);

            $this->call(UsersTableSeeder::class);
            $this->call(UserRolesTableSeeder::class);
            $this->call(UserPositionsTableSeeder::class);
            $this->call(AdminFieldsTableSeeder::class);
            $this->call(FieldsTableSeeder::class);

            $this->call(UnitsTableSeeder::class);
            $this->call(ItemsTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
            $this->call(CustomersTableSeeder::class);
        }
    }
}
