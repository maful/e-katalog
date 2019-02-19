<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('supplier')->truncate();
        $suppliers = factory(App\Supplier::class, 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
