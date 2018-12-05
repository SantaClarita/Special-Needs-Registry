<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoleTest extends TestCase
{
	use DatabaseTransactions;

    public function testCreateRole()
    {
        $role = factory(App\Role::class)->create(); //used to get the current id fop next create
        
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
        	 ->visit('/')
        	 ->click('Roles')
        	 ->seePageIs('/roles')
        	 ->click('Create a Role')
        	 ->type('Testing New Role','name')
        	 ->type('Hello World!','description')
        	 ->check('perm[1]')
        	 ->press('Submit')
        	 ->seeInDatabase('roles', [
        	 		'name' => 'Testing New Role',
        	 		'description' => 'Hello World!',
        	 	])
        	 ->seeInDatabase('permission_role', [
        	 		'role_id' => $role->id+1, //use the newly created ID for testing
        	 		'permission_id' => '1',
        	 	])
        	 ->see('Role "Testing New Role" was created successfully!');
    }

    public function testEditRole() {
        $newrole = factory(App\Role::class)->create([
        		'name' => 'New Role',
        		'description' => 'Hello Earth!',
        	]);
        $newrole->permissions()->attach(1);

        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/roles/edit/'.$newrole->id)
             ->seePageIs('/roles/edit/'.$newrole->id)
             ->type('Hello Jupiter!','name')
             ->type('Hello Flat Earth!','description')
             ->uncheck('perm[1]')
             ->check('perm[2]')
             ->press('Submit')
             ->seeInDatabase('roles', [
                    'name' => 'Hello Jupiter!',
                    'description' => 'Hello Flat Earth!',
                ])
             ->seeInDatabase('permission_role', [
                    'permission_id' => '2',
                    'role_id' => $newrole->id,
                ])
             ->notSeeInDatabase('permission_role', [
                    'permission_id' => '1',
                    'role_id' => $newrole->id,
                ])
             ->see('Role "Hello Jupiter!" was updated successfully!');
    }

    public function testDeleteRole() {
        $newrole = factory(App\Role::class)->create([
        		'name' => 'New Role',
        		'description' => 'Hello Earth!',
        	]);
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/roles')
             ->press('delete-role-'.$newrole->id)
             ->see('Role "'.$newrole->name.'" was deleted successfully!');
    }
}
