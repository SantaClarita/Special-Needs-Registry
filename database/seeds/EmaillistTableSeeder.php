<?php

use Illuminate\Database\Seeder;

class EmaillistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('emaillists')->insert([
            'id' => '1',
            'name' => 'Admin',
            'description' => 'Gets every email',
        ]);
        DB::table('emaillist_role')->insert([
            'id' => '1',
            'role_id' => '2',
            'emaillist_id' => '1',
        ]);
    }
}
