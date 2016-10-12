<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class BackendRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::beginTransaction();

        try {
            DB::statement('TRUNCATE TABLE roles');

            $backend_role = new Role();

            $backend_role->desc = 'site_admin';

            $backend_role->save();

            $backend_role = new Role();

            $backend_role->desc = 'psadmin';

            $backend_role->save();

            $backend_role = new Role();

            $backend_role->desc = 'ps';

            $backend_role->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
