<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@wscubetech.com',
            'password' => bcrypt('123456'),
            'platform' => config('constants.platforms.WEB.value')
        ]);

        // Get student role
        $role = Role::where([
            'type'   => config('constants.users.types.ADMIN.value'), 
            'status' => config('constants.statuses.ACTIVE.value')
        ])->first();
        //-----------------

        // Assign student role to user
        if (! is_null($user) && ! is_null($role)) {
            $user->assignRole($role->id);
        }
        //----------------------------
    }
}
