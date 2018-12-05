<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => '1',
            'name' => 'User',
            'description' => 'Standard new user functionality',
        ]);
        DB::table('roles')->insert([
            'id' => '2',
            'name' => 'Admin',
            'description' => 'Superuser power',
        ]);
        DB::table('roles')->insert([
            'id' => '3',
            'name' => 'Sheriff',
            'description' => 'Can search and view dependents',
        ]);
        DB::table('roles')->insert([
            'id' => '4',
            'name' => 'Maintenance',
            'description' => 'User management, roles and permissions management, and email list management',
        ]);
    }
}
