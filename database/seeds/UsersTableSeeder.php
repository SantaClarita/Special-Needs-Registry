<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fname' => 'Christopher',
            'lname' => 'Hernandez',
            'email' => 'user@example.com',
            'phone' => '1113334444',
            'password' => bcrypt('password'),
            'stopReminderEmails' => false,
        ]);
        DB::table('users')->insert([
            'fname' => 'Christopher',
            'lname' => 'Hernandez',
            'email' => 'admin@example.com',
            'phone' => '1113334444',
            'password' => bcrypt('password'),
            'stopReminderEmails' => false,
        ]);
        DB::table('users')->insert([
            'fname' => 'Christopher',
            'lname' => 'Hernandez',
            'email' => 'sheriff@example.com',
            'phone' => '1113334444',
            'password' => bcrypt('password'),
            'stopReminderEmails' => false,
        ]);
        DB::table('users')->insert([
            'fname' => 'Christopher',
            'lname' => 'Hernandez',
            'email' => 'maintenance@example.com',
            'phone' => '1113334444',
            'password' => bcrypt('password'),
            'stopReminderEmails' => false,
        ]);
    }
}
