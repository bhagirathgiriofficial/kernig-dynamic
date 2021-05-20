<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name'       => 'Admin',
                'is_default' => config('constants.is_default.YES.value'),
                'type'       => config('constants.users.types.ADMIN.value'),
            ],

            [
                'name'       => 'Student',
                'is_default' => config('constants.is_default.YES.value'),
                'type'       => config('constants.users.types.STUDENT.value'),
            ]
        ]);
    }
}
