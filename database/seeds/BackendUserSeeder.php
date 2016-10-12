<?php

use Illuminate\Database\Seeder;
use App\Models\BackendUser;

class BackendUserSeeder extends Seeder
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
            DB::statement('TRUNCATE TABLE backend_users');

            $backend_user = new BackendUser();

            $backend_user->account = 'admin@xx.com';
            $backend_user->password = 'Qaz123*()';
            $backend_user->username = 'test_admin';
            $backend_user->status = true;
            $backend_user->role_id = 1;

            $backend_user->save();

            $backend_user = new BackendUser();

            $backend_user->account = 'ld001@xx.com';
            $backend_user->password = 'Password01!';
            $backend_user->username = 'cpd001';
            $backend_user->status = true;
            $backend_user->role_id = 2;

            $backend_user->save();

            $backend_user = new BackendUser();

            $backend_user->account = 'ld002@xx.com';
            $backend_user->password = 'asd123*()';
            $backend_user->username = 'cpd002';
            $backend_user->status = true;
            $backend_user->role_id = 3;

            $backend_user->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
