<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipantTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Common executable path for a regular user
     */
    public function testCreateApplication()
    {
        $this->visit('/')
             ->click('Login')
             ->seePageIs('/login')
             ->type('admin@example.com','email')
             ->type('password','password')
             ->press('Login')
             ->seePageIs('/participants')
             ->click('Add a Participant')
             ->seePageIs('/applications/create')
             ->attach('public/images/test.png', 'image')
             ->type('Jane','fname')
             ->type('Y', 'middleinitial')
             ->type('Doe', 'lname')
             ->type('Miss Universe', 'nickname')
             ->select('6', 'month')
             ->select('27', 'day')
             ->select('1993', 'year')
             ->select('Female', 'gender')
             ->press('Start Application')
             ->seeInDatabase('participants', 
                [
                    'fname' => 'Jane',
                    'middleinitial' => 'Y',
                    'lname' => 'Doe',
                    'nickname' => 'Miss Universe',
                    'birthdate' => '1993-06-27 00:00:00',
                    'gender' => 'Female',
                ]);

        $this->select('6', 'ethnicity1')
             ->select('7', 'ethnicity2')
             ->type('Black', 'haircolor')
             ->select('Brown', 'eyecolor')
             ->select('5','heightfeet')
             ->select('4','heightinch')
             ->type('100', 'weight')
             ->type('Has trouble with reading sentences.', 'disability')
             ->type('She has a mole in the arm and leg.', 'identifyingfeatures')
             ->type('She carries around a ClearSCV card at all times.', 'idonparticipant')
             ->type('Speak softly and calmly.', 'approachsuggestions')
             ->press('Save')
             ->seeInDatabase('participants', 
                [
                    
                    'ethnicity1' => '6',
                    'ethnicity2' => '7',
                    'haircolor' => 'Black',
                    'eyecolor' => 'Brown',
                    'height' => '64',
                    'weight' => '100',
                    'disability' => 'Has trouble with reading sentences.',
                    'identifyingfeatures' => 'She has a mole in the arm and leg.',
                    'idonparticipant' => 'She carries around a ClearSCV card at all times.',
                    'approachsuggestions' => 'Speak softly and calmly.',
                ]);

             $this->select('1','livealone')
             ->select('2','typeofresidence')
             ->type('111 Valencia Dr', 'address1')
             ->type('Suite 16', 'address2')
             ->type('Santa Clarita', 'city')
             ->type('CA', 'state')
             ->type('92521', 'zip')
             ->type('8183334444', 'homephone')
             ->type('9193334444', 'cellphone')
             ->select('2', 'eme_relation')
             ->type('Alex Bones','eme_name')
             ->type('222 Raidroad Dr', 'eme_address1')
             ->type('Suite 24', 'eme_address2')
             ->type('Santa Clara', 'eme_city')
             ->type('CA', 'eme_state')
             ->type('91111', 'eme_zip')
             ->type('8182224444', 'eme_homephone')
             ->type('9192224444', 'eme_cellphone')
             ->select('3','alt_eme_relation')
             ->type('Bryan Gracias','alt_eme_name')
             ->type('333 Lyon Dr', 'alt_eme_address1')
             ->type('Suite 21', 'alt_eme_address2')
             ->type('Santa Monica', 'alt_eme_city')
             ->type('CA', 'alt_eme_state')
             ->type('92222', 'alt_eme_zip')
             ->type('8184448888', 'alt_eme_homephone')
             ->type('9193339999', 'alt_eme_cellphone')
             ->press('Save')
             ->seeInDatabase('participants', 
                [
                    'livealone' => '1',
                    'typeofresidence' => '2',
                    'address1' => '111 Valencia Dr',
                    'address2' => 'Suite 16',
                    'city' => 'Santa Clarita',
                    'state' => 'CA',
                    'zip' => '92521',
                    'homephone' => '8183334444',
                    'cellphone' => '9193334444',
                    'eme_relation' => '2',
                    'eme_name' => 'Alex Bones',
                    'eme_address1' => '222 Raidroad Dr',
                    'eme_address2' => 'Suite 24',
                    'eme_city' => 'Santa Clara',
                    'eme_state' => 'CA',
                    'eme_zip' => '91111',
                    'eme_homephone' => '8182224444',
                    'eme_cellphone' => '9192224444',
                    'alt_eme_relation' => '3',
                    'alt_eme_name' => 'Bryan Gracias',
                    'alt_eme_address1' => '333 Lyon Dr',
                    'alt_eme_address2' => 'Suite 21',
                    'alt_eme_city' => 'Santa Monica',
                    'alt_eme_state' => 'CA',
                    'alt_eme_zip' => '92222',
                    'alt_eme_homephone' => '8184448888',
                    'alt_eme_cellphone' => '9193339999',
                ]);

            $this->type('1','wanders')
             ->type('Possibly at the park or disneyland.','possiblelocations')
             ->type('He might yell at you when he starts to get nervous.','behaviorialhazards')
             ->type('If he yells, try to bring up stuff like cartoons.','otherinfo')
             ->type('English', 'primarylang')
             ->type('Spanish','secondarylang')
             ->type('Verbal is fine.','communicationmethod')
             ->press('Save')
             ->seeInDatabase('participants', 
                [
                    'wanders' => '1',
                    'possiblelocations' => 'Possibly at the park or disneyland.',
                    'behaviorialhazards' => 'He might yell at you when he starts to get nervous.',
                    'otherinfo' => 'If he yells, try to bring up stuff like cartoons.',
                    'primarylang' => 'English',
                    'secondarylang' => 'Spanish',
                    'communicationmethod' => 'Verbal is fine.',
                ])
             ->type('Dr Bob Vance', 'physicianname1')
             ->type('8888888888', 'physicianphone1')
             ->type('Dr Kobe James', 'physicianname2')
             ->type('2428882424','physicianphone2')
             ->check('disab[1]')
             ->check('disab[2]')
             ->check('disab[3]')
             ->check('disab[4]')
             ->check('disab[5]')
             ->type("He sometimes gets really anxious around people.",'otherconditions')
             ->type('100g of stimulants.','medication')
             ->type('He requires his pills daily.','medicalrequirements')
             ->type('Heartpacer.','medicaldevices')
             ->press('Save')
             ->seeInDatabase('participants',
                [
                    'physicianname1' => 'Dr Bob Vance',
                    'physicianphone1' => '8888888888',
                    'physicianname2' => 'Dr Kobe James',
                    'physicianphone2' => '2428882424',
                    'otherconditions' => 'He sometimes gets really anxious around people.',
                    'medication' => '100g of stimulants.',
                    'medicalrequirements' => 'He requires his pills daily.',
                    'medicaldevices' => 'Heartpacer.',
                ]);

             $this->type('Christopher Hernandez', 'digitalsig')
             ->check('authorize')
             ->expectsJobs(App\Jobs\SendParticipantEditAddEmail::class)
             ->press('Submit')
             ->seeInDatabase('participants',
                [
                    'digitalsig' => 'Christopher Hernandez',
                ]);
    }

    public function testViewID() {
        $participant = factory(App\Participant::class)->create();
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/ID/'.$participant->id)
             ->seePageIs('/participants/ID/'.$participant->id)
             ->see('SCV SPECIAL NEEDS REGISTRY: CLEARSCV.ORG');
    }

    public function testViewProfile() {
        $participant = factory(App\Participant::class)->create();
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/profile/'.$participant->id)
             ->seePageIs('/participants/profile/'.$participant->id)
             ->see("Participant's Personal Information");
    }

    public function testEditProfile() {
        $participant = factory(App\Participant::class)->create();

        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/edit/'.$participant->id)
             ->seePageIs('/participants/edit/'.$participant->id)
             ->type('Hernandez','lname')
             ->check('disab[1]')
             ->check('authorize')
             ->press('Submit')
             ->see('Participant "'.$participant->fname.' Hernandez" was updated successfully!');
             //Log::info($this->response->getContent());
    }

    public function testDeleteParticipant() {
        $newparticipant = factory(App\Participant::class)->create([
                'fname' => 'wxyz',
                'lname' => 'abcd',
            ]);

        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/search')
             ->type('wxyz abcd','search')
             ->press('search_icon')
             ->press('delete-participant-'.$newparticipant->id)
             ->see($newparticipant->fname.' '.$newparticipant->middleinitial.' '.$newparticipant->lname.' was deleted successfully!');
    }

    public function testRestoreParticipant() {
        $newparticipant = factory(App\Participant::class)->create([
                'fname' => 'wxyz',
                'lname' => 'abcd',
                'deleted_at' => Carbon\Carbon::now(),
            ]);

        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/search')
             ->type('wxyz abcd','search')
             ->check('searchdeleted')
             ->press('search_icon')
             ->press('restore-participant-'.$newparticipant->id)
             ->see($newparticipant->fname.' '.$newparticipant->middleinitial.' '.$newparticipant->lname.' was restored successfully!');
    }

    public function testViewFlyer() {
        $participant = factory(App\Participant::class)->create();
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/flyer/'.$participant->id)
             ->seePageIs('/participants/flyer/'.$participant->id)
             ->see("Missing Person Information");
    }

    public function testSendFlyer() {
        $participant = factory(App\Participant::class)->create();
        $user = factory(App\User::class)->create();
        $user->roles()->attach(2);
        $this->actingAs($user)
             ->visit('/participants/flyer/'.$participant->id)
             ->seePageIs('/participants/flyer/'.$participant->id)
             ->expectsJobs(App\Jobs\SendFlyerEmail::class)
             ->press('Yes')
             ->see('Your flyer email was sent!')
             ->click('Download')
             ->seePageIs('/participants/showFlyerPDF/'.$participant->id)
             ->seeStatusCode(200);
    }
}