<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class vw_participant extends Model
{
	use SearchableTrait;
    use SoftDeletes;

    //How matches are ranked. These are the weights
    protected $searchable = [
        'columns' => [
                'vw_participants.fname' => 10,
                'vw_participants.lname' => 10,
                'vw_participants.id' => 20,
                'vw_participants.gender' => 5,
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

    public function imagechk()
    {
        return Storage::disk('local')->exists($this->image_link);
    }

    public function age() {
        if ($this->birthdate->age != 0)
            return $this->birthdate->age." years old";
        else
            return $this->birthdate->diffInMonths( Carbon::now() )." months old";
    }
}
