<?php

use Illuminate\Database\Seeder;
use App\Masterfile;
use Illuminate\Support\Facades\DB;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function (){
            DB::table('users')->delete();
            $admin_mf = Masterfile::where('surname', 'Admin')->first();
            $role = Role::where('role_code','SYS_ADMIN')->first();
            DB::table('users')->delete();
            $admin = new \App\User();
            $admin->name = 'Admin';
            $admin->email = 'admin@admin.com';
            $admin->user_role = $role->id;
            $admin->mf_id = $admin_mf->id;
            $admin->password = bcrypt(123456);
            $admin->save();
        });
    }
}
