<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserManagementTest extends TestCase
{
    use DatabaseTransactions;

    public function testUserRegister() {
        $this->visit('/')
        	 ->click('Register')
        	 ->seePageIs('/register')
        	 ->type('Chris','fname')
        	 ->type('Hernandez','lname')
        	 ->type('testunit@gmail.com','email')
        	 ->type('8183334444','phone')
        	 ->type('password','password')
        	 ->type('password','password_confirmation')
        	 ->press('Register')
        	 ->seePageIs('/participants')
        	 ->seeInDatabase('users', ['email' => 'testunit@gmail.com']);
    }

   	public function testEditPersonalInfo() {
   		$user = factory(App\User::class)->create([  
                'password' => bcrypt('password'),
            ]);
        $user->roles()->attach(2);
        $this->actingAs($user)
        	 ->visit('/')
        	 ->click('Edit Information')
        	 ->seePageIs('/users/editpersonalinfo')
        	 ->type('2224446666','phone')
        	 ->type('password', 'old-password')
        	 ->press('Submit')
        	 ->see('Your personal information was updated successfully!');
   	}

   	public function testCreateUser() {
   		$user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/')
        	 ->click('Users')
        	 ->seePageIs('/users')
        	 ->click('Add a User')
        	 ->type('New','fname')
        	 ->type('Test','lname')
        	 ->type('1112223333','phone')
        	 ->type('testingnewuser@gmail.com', 'email')
        	 ->type('password','password')
        	 ->type('password','password_confirmation')
        	 ->check('role[2]')
        	 ->press('Register')
             ->seeInDatabase('users', [
                    'fname' => 'New',
                    'lname' => 'Test',
                    'email' => 'testingnewuser@gmail.com',
                ])
        	 ->see('User email "testingnewuser@gmail.com" was created successfully!');
   	}

    public function testEditUser() {
        $newuser = factory(App\User::class)->create(['email' => 'newusertest@gmail.com']);
        $newuser->roles()->attach(1);
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);

        $this->seeInDatabase('role_user', [
                    'role_id' => '1',
                    'user_id' => $newuser->id,
                ]);
        $this->actingAs($user)
             ->visit('/users/edit/'.$newuser->id)
             ->seePageIs('/users/edit/'.$newuser->id)
             ->type('checkcheck','fname')
             ->uncheck('role[1]')
             ->check('role[3]')
             ->press('Submit')
             ->seeInDatabase('users', [
                    'fname' => 'checkcheck',
                    'email' => 'newusertest@gmail.com',
                ])
             ->seeInDatabase('role_user', [
                    'role_id' => '3',
                    'user_id' => $newuser->id,
                ])
             ->notSeeInDatabase('role_user', [
                    'role_id' => '1',
                    'user_id' => $newuser->id,
                ])
             ->see('User email "'.$newuser->email.'" was updated successfully!');

    }

    public function testDeleteUser() {
        $newuser = factory(App\User::class)->create(['email' => 'newusertest@gmail.com']);
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/users')
             ->type('newusertest','search_user')
             ->press('search_icon')
             ->press('delete-user-'.$newuser->id)
             ->see('User email "'.$newuser->email.'" was deleted successfully!');

    }

    public function testRestoreUser() {
        $newuser = factory(App\User::class)->create([
                'email' => 'newusertest@gmail.com', 
                'deleted_at' => Carbon\Carbon::now(),
            ]);
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/users')
             ->type('newusertest','search_user')
             ->check('searchdeleted')
             ->press('search_icon')
             ->press('restore-user-'.$newuser->id)
             ->see($newuser->fname.' '.$newuser->lname.' was restored successfully!');

    }
}
