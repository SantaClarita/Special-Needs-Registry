<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //superuser
        DB::table('permission_role')->insert([
            'id' => '1',
            'permission_id' => '1',
            'role_id' => '2',
        ]);

        //Sheriff
        DB::table('permission_role')->insert([
            'id' => '3',
            'permission_id' => '3',
            'role_id' => '3',
        ]);

        DB::table('permission_role')->insert([
            'id' => '4',
            'permission_id' => '4',
            'role_id' => '3',
        ]);
        DB::table('permission_role')->insert([
            'id' => '5',
            'permission_id' => '5',
            'role_id' => '3',
        ]);
        DB::table('permission_role')->insert([
            'id' => '6',
            'permission_id' => '6',
            'role_id' => '3',
        ]);
        DB::table('permission_role')->insert([
            'id' => '7',
            'permission_id' => '7',
            'role_id' => '3',
        ]);

        //Maintenance
        DB::table('permission_role')->insert([
            'id' => '8',
            'permission_id' => '8',
            'role_id' => '4',
        ]);
        DB::table('permission_role')->insert([
            'id' => '9',
            'permission_id' => '9',
            'role_id' => '4',
        ]);
        DB::table('permission_role')->insert([
            'id' => '10',
            'permission_id' => '10',
            'role_id' => '4',
        ]);
        DB::table('permission_role')->insert([
            'id' => '11',
            'permission_id' => '11',
            'role_id' => '4',
        ]);
        DB::table('permission_role')->insert([
            'id' => '12',
            'permission_id' => '12',
            'role_id' => '4',
        ]);
    }
}
