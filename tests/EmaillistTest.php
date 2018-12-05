<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmaillistTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateEmaillist()
    {
        $emaillist = factory(App\Emaillist::class)->create(); //used to get the current id fop next create
        
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user);
        $response = $this->call('POST', '/emaillists/store', [
            'name' => 'Testing', 
            'description' => 'Test des',
            'email' => [''],
        ]);
        $this->assertRedirectedTo('/emaillists');
             
    }
    public function testEditEmaillist() {
        $newemaillist = factory(App\Emaillist::class)->create([
        		'name' => 'New Email List',
        		'description' => 'Hello Mercury!',
        	]);
        $newemaillist->roles()->attach(1);
        $temp[0] = array('email' => 'cherna@ucr.edu');
        $temp[1] = array('email' => 'test@santa.com');
        $newemaillist->useremails()->createMany($temp);

        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/emaillists/edit/'.$newemaillist->id)
             ->seePageIs('/emaillists/edit/'.$newemaillist->id)
             ->see($newemaillist->name.' Email List')
             ->type('Hello Jupiter!','name')
             ->type('Hello Flat Earth!','description')
             ->uncheck('role[2]')
             ->check('role[3]')
             ->press('Submit')
             ->notSeeInDatabase('emaillist_role', [
        	 		'emaillist_id' => $newemaillist->id,
        	 		'role_id' => '2',
        	 	])
             ->seeInDatabase('emaillistrecipients', [
        	 		'emaillist_id' => $newemaillist->id,
        	 		'email' => 'cherna@ucr.edu',
        	 	])
             ->seeInDatabase('emaillist_role', [
        	 		'emaillist_id' => $newemaillist->id,
        	 		'role_id' => '3',
        	 	])
        	 ->seeInDatabase('emaillistrecipients', [
        	 		'emaillist_id' => $newemaillist->id,
        	 		'email' => 'test@santa.com',
        	 	])
             ->see('Email List "Hello Jupiter!" was updated successfully!');
    }

    public function testDeleteEmaillist() {
        $newemaillist = factory(App\Emaillist::class)->create([
        		'name' => 'New Email List',
        		'description' => 'Hello Mercury!',
        	]);
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/emaillists')
             ->see('Email Lists')
             ->press('delete-emaillist-'.$newemaillist->id)
             ->see('Email List "'.$newemaillist->name.'" was deleted successfully!');
    }

    /*public function testSendMail() {
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/emaillists')
             ->type('Testing Email Subject','subject')
             ->type('This is your manual print form','body')
             ->attach('public/documents/SNRSCV_printfill.pdf', 'attachment')
             ->expectsJobs(App\Jobs\SendEmailListMail::class)
             ->press('Submit');
    }*/
}
