<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Setting;

class SettingTest extends TestCase
{
	use DatabaseTransactions;

    public function testEditSetting() {
    	$emaillist = factory(App\Emaillist::class)->create();
    	$secondemaillist = factory(App\Emaillist::class)->create();
    	$setting = Setting::find(2);
    	$setting->emaillists()->attach($emaillist->id);
    	$setting->emaillists()->attach($secondemaillist->id);
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/settings/edit/2')
             ->seePageIs('/settings/edit/2')
             //->select([$emaillist->id], 'setting[]') //multiselect breaks phpunit in laravel 5.2. Fix is rolled out for 5.3
             ->press('Submit')
             ->seeInDatabase('emaillist_setting', [
        	 		'emaillist_id' => $emaillist->id, //use the newly created ID for testing
        	 		'setting_id' => 2,
        	 	])
             ->seeInDatabase('emaillist_setting', [
        	 		'emaillist_id' => $secondemaillist->id, //use the newly created ID for testing
        	 		'setting_id' => 2,
        	 	])
             ->see('Settings "Contact Us" was updated successfully!');
    }

    public function testDeleteSetting() {
    	$emaillist = factory(App\Emaillist::class)->create();
    	$setting = Setting::find(2);
    	$setting->emaillists()->attach($emaillist->id);

        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/settings')
             ->press('delete-setting-'.$emaillist->id)
             ->see('Email List "'.$emaillist->name.'" was removed successfully from "Contact Us" settings!');
    }
}
