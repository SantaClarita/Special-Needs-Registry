<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    // helper data getters
    protected $dates = ['birthdate'];

    protected $genders = array(
        '1' => 'Male',
        '2' => 'Female'
    );

    protected $fillable = [
        'fname', 'middleinitial', 'lname', 'nickname', 'birthdate', 'gender', 'ethnicity1', 'ethnicity2',
        'image_link', 'haircolor', 'eyecolor', 'height', 'weight', 'disability', 
        'identifyingfeatures', 'idondependent', 'approachsuggestions', 'livealone', 

        'typeofresidence', 'address1', 'address2', 'city', 'state', 'zip', 'homephone', 
        'cellphone', 

        'eme_name', 'eme_relation', 'eme_address1', 'eme_address2', 'eme_city', 
        'eme_state', 'eme_zip', 'eme_homephone', 'eme_cellphone', 

        'alt_eme_name', 'alt_eme_relation', 'alt_eme_address1', 'alt_eme_address2', 
        'alt_eme_city', 'alt_eme_state', 'alt_eme_zip', 'alt_eme_homephone', 
        'alt_eme_cellphone', 

        'wanders', 'possiblelocations', 'behaviorialhazards', 'otherinfo', 
        'primarylang', 'secondarylang', 'communcationmethod', 
        'otherconditions', 'physicianname1', 'physicianphone1', 'physicianname2', 
        'physicianphone2', 'medication', 'medicalrequirements', 'medicaldevices', 

        'digitalsig'
    ];

    //Relationship
    public function disabilities()
    {
        return $this->belongsToMany('App\Disability');
    }
}
