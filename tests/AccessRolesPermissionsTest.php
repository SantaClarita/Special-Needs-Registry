<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Role;
use App\User;

class AccessRolesPermissionsTest extends TestCase
{

 	use DatabaseTransactions;
    /**
     *
     * @return void
     */
    public function testPermissionCanEditAnyParticipants()
    {
    	$two = factory(App\Role::class)->create([
    			'name' => 'TestingTwo'
    		]);
    	$two->permissions()->attach(2);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($two->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->visit('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(200);
    }

    public function testPermissionCanSearch()
    {
    	$three = factory(App\Role::class)->create([
    			'name' => 'TestingThree'
    		]);
    	$three->permissions()->attach(3);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($three->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->visit('/participants/search')
    		 ->seeStatusCode(200);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanViewAnyProfile()
    {
    	$four = factory(App\Role::class)->create([
    			'name' => 'TestingFour'
    		]);
    	$four->permissions()->attach(4);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($four->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->visit('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(200);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanViewAnyFlyer()
    {
    	$five = factory(App\Role::class)->create([
    			'name' => 'TestingFive'
    		]);
    	$five->permissions()->attach(5);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($five->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->visit('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(200);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanViewAnyID()
    {
    	$six = factory(App\Role::class)->create([
    			'name' => 'TestingThree'
    		]);
    	$six->permissions()->attach(6);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($six->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->visit('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(200);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanSendFlyerEmail()
    {
    	$seven = factory(App\Role::class)->create([
    			'name' => 'TestingSeven'
    		]);
    	$seven->permissions()->attach([5,7]);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($seven->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->visit('/participants/flyer/'.$participant->id)
    		 ->seePageIs('/participants/flyer/'.$participant->id)
             ->expectsJobs(App\Jobs\SendFlyerEmail::class)
             ->press('Yes');
    }

    public function testPermissionCanManageRolesPermissions()
    {
    	$eight = factory(App\Role::class)->create([
    			'name' => 'TestingEight'
    		]);
    	$eight->permissions()->attach(8);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($eight->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->visit('/roles')
    		 ->seeStatusCode(200);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanManageUsers()
    {
    	$nine = factory(App\Role::class)->create([
    			'name' => 'TestingNine'
    		]);
    	$nine->permissions()->attach(9);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($nine->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->visit('/users')
    		 ->seeStatusCode(200);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanManageEmaillists()
    {
    	$ten = factory(App\Role::class)->create([
    			'name' => 'TestingTen'
    		]);
    	$ten->permissions()->attach(10);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($ten->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->visit('/emaillists')
    		 ->seeStatusCode(200);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionCanManageEmaillSettings()
    {
    	$eleven = factory(App\Role::class)->create([
    			'name' => 'TestingEleven'
    		]);
    	$eleven->permissions()->attach(11);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($eleven->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->visit('/settings')
    		 ->seeStatusCode(200);
    	$this->get('/logs')
    		 ->seeStatusCode(401);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    }

    public function testPermissionViewLogs()
    {
    	$twelve = factory(App\Role::class)->create([
    			'name' => 'TestingTwelve'
    		]);
    	$twelve->permissions()->attach(12);

    	$user = factory(App\User::class)->create();
    	$user->roles()->attach($twelve->id);

    	$participant = factory(App\Participant::class)->create();

    	$this->actingAs($user);
    	$this->get('/users')
    		 ->seeStatusCode(401);
    	$this->get('/roles')
    		 ->seeStatusCode(401);
    	$this->get('/emaillists')
    		 ->seeStatusCode(401);
    	$this->get('/settings')
    		 ->seeStatusCode(401);
    	$this->visit('/logs')
    		 ->seeStatusCode(200);
    	$this->get('/participants/search')
    		 ->seeStatusCode(401);
    	$this->get('/participants/profile/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/ID/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/edit/'.$participant->id)
    		 ->seeStatusCode(401);
    	$this->get('/participants/flyer/'.$participant->id)
    		 ->seeStatusCode(401);
    }
}
