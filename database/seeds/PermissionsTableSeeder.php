<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //admin
        DB::table('permissions')->insert([
            'id' => '1',
            'name' => 'Superuser',
            'description' => 'Can perform anything',
        ]);

    	//...
        DB::table('permissions')->insert([
            'id' => '2',
            'name' => 'Can manage ALL participant',
            'description' => 'Add/Remove/Edit ALL participant information',
        ]);

        //sheriff
        DB::table('permissions')->insert([
            'id' => '3',
            'name' => 'Can search participants',
            'description' => 'Ability to perform searches for participants',
        ]);
        DB::table('permissions')->insert([
            'id' => '4',
            'name' => 'Can view ALL participant profiles',
            'description' => 'Ability to view any participant profiles',
        ]);
        DB::table('permissions')->insert([
            'id' => '5',
            'name' => 'Can view ALL participant flyers',
            'description' => 'Ability to view any participant flyers',
        ]);
        DB::table('permissions')->insert([
            'id' => '6',
            'name' => 'Can view ALL participant IDs',
            'description' => 'Ability to view any participant IDs',
        ]);
        DB::table('permissions')->insert([
            'id' => '7',
            'name' => 'Can send email flyer for participant',
            'description' => 'Ability to send email flyer for a missing person',
        ]);

        //maintenance
        DB::table('permissions')->insert([
            'id' => '8',
            'name' => 'Can manage roles and permissions',
            'description' => 'Ability to create/edit/delete roles. Ability to attach/detach permissions to roles',
        ]);
        DB::table('permissions')->insert([
            'id' => '9',
            'name' => 'Can manage users',
            'description' => 'Ability to create/edit/delete users',
        ]);
        DB::table('permissions')->insert([
            'id' => '10',
            'name' => 'Can manage email lists',
            'description' => 'Ability to create/edit/delete email lists and send email',
        ]);
        DB::table('permissions')->insert([
            'id' => '11',
            'name' => 'Can manage email settings',
            'description' => 'Ability to assign emaillist to different email functions of the application',
        ]);
        DB::table('permissions')->insert([
            'id' => '12',
            'name' => 'Can view logs',
            'description' => 'Ability to view log files',
        ]);
    }
}
