<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Nicolaslopezj\Searchable\SearchableTrait;
use Carbon;
use Storage;

class Participant extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    //How matches are ranked. These are the weights
    protected $searchable = [
        'columns' => [
                'participants.fname' => 10,
                'participants.lname' => 10,
                'participants.id' => 20,
            ],
    ];


    //Data helpers for getters
    protected $dates = ['birthdate','deleted_at'];

    protected $binary = array(
        '1' => 'Yes',
        '0' => 'No',
        '2' => 'No', //for bad data 
        '3' => 'Sometimes' //for bad data 
    );
    protected $residence = array(
        '1' => 'Family Home',
        '2' => 'Group Home',
        '3' => 'Other',
    );
    protected $ethnicities = array(
        '0' => 'Unknown',
        '1' => 'Asian',
        '2' => 'American Indian',
        '3' => 'Black',
        '4' => 'Chinese',
        '5' => 'Filipino',
        '6' => 'Hispanic',
        '7' => 'Japanese',
        '8' => 'Pacific Islander',
        '9' => 'White',
        '10' => 'Mixed',
        '11' => 'Other',
    );
    protected $relationships = array(
        '1' => 'Parent',
        '2' => 'Guardian/Caregiver',
        '3' => 'Spouse',
        '4' => 'Son/Daughter',
        '5' => 'Brother/Sister',
        '6' => 'Other',
        '0' => 'None',
    );

    protected $fillable = [

        'fname', 'middleinitial', 'lname', 'nickname', 'birthdate', 'gender', 
        'image_link', 'haircolor', 'eyecolor', 'height', 'weight', 'disability', 
        'identifyingfeatures', 'idonparticipant', 'approachsuggestions', 'livealone', 

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

    //Getters
    public function getEthnicity1Attribute($value)
    {   
        if($value != null || $value != '')
            return $this->ethnicities[$value];
        return;
    }
    public function getEthnicity2Attribute($value)
    {   
        if($value != null || $value != '')
            return $this->ethnicities[$value];
        return;
    }
    public function getLivealoneAttribute($value)
    {
        if(($value != null || $value === 0) || $value != '' )
            return $this->binary[$value];
        return;
    }
    public function getTypeofresidenceAttribute($value)
    {
        if($value != null || $value != '')
            return $this->residence[$value];
        return;
    }
    public function getEmeRelationAttribute($value)
    {
        if($value != null || $value != '')
            return $this->relationships[$value];
        return;
    }
    public function getAltEmeRelationAttribute($value)
    {
        if($value != null || $value != '')
            return $this->relationships[$value];
        return;
    }
    public function getWandersAttribute($value)
    {
        if(($value != NULL || $value === 0) || $value != '' )
            return $this->binary[$value];
        return;
    }

    //Note: These next two functions were created to accommodate the bad data from the old database
    //Height is stored as a regular int (string). So we must convert from string to intval. 
    //Then, we parse that int if it is considered good data.
    //If it isn't good data then we have no choice but to spit out the bad data AS IS.
    public function getHeightAttribute($value)
    {   
        if ( is_numeric($value)){
            $feet = intval($value/12);
            $inches = $value%12;
            return strval($feet)."'".strval($inches).'"';
        }
        else
            return $value;
    }

    //If weight is valid values we spit out value + lbs
    //This is to distinguish the bad data from the good data
    public function getWeightAttribute($value)
    {   
        if ( is_numeric($value) ){
            return $value.' lbs';
        }
        else
            return $value;
    }
    public function getHomephoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getCellphoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getEmehomephoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getEmecellphoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getAltemehomephoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getAltemecellphoneAttribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getPhysicianphone1Attribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }
    public function getPhysicianphone2Attribute($value)
    {   
        if ( is_numeric($value)){
            return '('.substr($value, 0, 3).') '.substr($value, 3, 3).'-'.substr($value, 6, 4);
        }
        else
            return $value;
    }

    //SETTERS
    /*public function setHomephoneAttribute($value)
    {   
        $this->attributes['homephone'] = preg_replace("/[^0-9]/","", $value);
    }
    public function setCellphoneAttribute($value)
    {   
        $this->attributes['cellphone'] = preg_replace("/[^0-9]/","", $value);
    }*/
    /*public function setEmehomephoneAttribute($value)
    {   
       $this->attributes['eme_homephone'] = preg_replace("/[^0-9]/","", $value);
    }
    public function setEmecellphoneAttribute($value)
    {   
        $this->attributes['eme_cellphone'] = preg_replace("/[^0-9]/","", $value);
    }
    public function setAltemehomephoneAttribute($value)
    {   
        $this->attributes['alt_eme_homephone'] = preg_replace("/[^0-9]/","", $value);
    }
    public function setAltemecellphoneAttribute($value)
    {   
        $this->attributes['alt_eme_cellphone'] = preg_replace("/[^0-9]/","", $value);
    }
     public function setPhysicianphone1Attribute($value)
    {   
        $this->attributes['physicianphone1'] = preg_replace("/[^0-9]/","", $value);
    }
    public function setPhysicianphone2Attribute($value)
    {   
        $this->attributes['physicianphone2'] = preg_replace("/[^0-9]/","", $value);
    }*/
    public function setWeightAttribute($value)
    {   
        $this->attributes['weight'] = preg_replace("/[^0-9]/","", $value);
    }

    //Relationships
    public function user() 
    { 
        return $this->belongsTo(User::class); 
    }
    public function ethnicities()
    {
        return $this->belongsToMany('App\Ethnicity');
    }
    public function disabilities()
    {
        return $this->belongsToMany('App\Disability');
    }

    //Checks
    public function imagechk()
    {
        return Storage::disk('local')->exists($this->image_link);
    }

    //Appended values
    public function age() {
        if ($this->birthdate->age != 0)
            return $this->birthdate->age." years old";
        else
            return $this->birthdate->diffInMonths( Carbon\Carbon::now() )." months old";
    }
}
