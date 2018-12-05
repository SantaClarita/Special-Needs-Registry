<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('settings')->insert([
        //    'id' => '1',
        //    'name' => 'New User',
        //    'description' => 'When a new user registers',
        //]);
        DB::table('settings')->insert([
            'id' => '2',
            'name' => 'Contact Us',
            'description' => 'Who will receive the email when a user uses the Contact Us Form',
        ]);
        DB::table('settings')->insert([
            'id' => '3',
            'name' => 'Flyer Email',
            'description' => 'Who will receive the email when a user presses the email flyer button',
        ]);
        //DB::table('settings')->insert([
        //    'id' => '4',
        //    'name' => 'Dependent Is Added',
        //    'description' => 'Who will receive the email when a user adds a Dependent',
        //]);
        /*DB::table('settings')->insert([
            'id' => '5',
            'name' => 'Send Two ID Cards',
            'description' => 'Who will receive the email when a user requests ID cards',
        ]);*/

        //pivot table
        //DB::table('emaillist_setting')->insert([
        //    'id' => '1',
        //    'setting_id' => '1',
        //    'emaillist_id' => '1',
        //]);
        //pivot table
        DB::table('emaillist_setting')->insert([
            'id' => '2',
            'setting_id' => '2',
            'emaillist_id' => '1',
        ]);
        DB::table('emaillist_setting')->insert([
            'id' => '3',
            'setting_id' => '3',
            'emaillist_id' => '1',
        ]);
        //DB::table('emaillist_setting')->insert([
        //    'id' => '4',
        //    'setting_id' => '4',
        //    'emaillist_id' => '1',
        //]);
        //DB::table('emaillist_setting')->insert([
        //    'id' => '5',
        //    'setting_id' => '5',
        //    'emaillist_id' => '1',
        //]);
    }
}
