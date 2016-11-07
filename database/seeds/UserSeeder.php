<?php

use Illuminate\Database\Seeder;
use App\Masterfile;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_mf = Masterfile::where('surname', 'Admin')->first();
        DB::table('users')->delete();
        $admin = new \App\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@admin.com';
        $admin->mf_id = $admin_mf->id;
        $admin->password = bcrypt(123456);
        $admin->save();
    }
}
