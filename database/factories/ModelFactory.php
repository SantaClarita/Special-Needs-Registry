<?php

/*
--------------------------------------------------------------------------
 Model Factories
--------------------------------------------------------------------------

 Here you may define all of your model factories. Model factories give
 you a convenient way to create models for testing and seeding your
 database. Just tell the factory how a default model should look.

*/

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
$factory->define(App\Emaillist::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'lname' => $faker->name,
        'fname' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'stopReminderEmails' => false,
    ];
});

$factory->define(App\Participant::class, function (Faker\Generator $faker) {
    $gender = ['Male', 'Female'];
    return [
        'lname' => $faker->name,
        'middleinitial' => '',
        'fname' => $faker->name,
        'nickname' => $faker->name,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender' => $gender[$faker->numberBetween($min = 0, $max = 1)],
        'ethnicity1' => $faker->numberBetween($min = 1, $max = 7),
        'ethnicity2' => $faker->numberBetween($min = 1, $max = 7),
        'haircolor' => $faker->colorName,
        'eyecolor' => $faker->colorName,
        'height' => $faker->numberBetween($min = 13, $max = 80),
        'weight' => $faker->numberBetween($min = 1, $max = 300),
        'disability' => $faker->word,
        'identifyingfeatures' => $faker->text($maxNbChars = 100)    ,
        'idonparticipant' => $faker->text($maxNbChars = 100)   ,
        'approachsuggestions' => $faker->text($maxNbChars = 100)    ,
        'livealone' =>  $faker->numberBetween($min = 0, $max = 1),
        'typeofresidence' => $faker->numberBetween($min = 1, $max = 3),
        'address1' => $faker->streetAddress,
        'address2' => $faker->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip' => $faker->postcode,
        'homephone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'cellphone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'eme_relation' => $faker->numberBetween($min = 1, $max = 6),
        'eme_name' => $faker->name,
        'eme_address1' => $faker->streetAddress,
        'eme_address2' => $faker->secondaryAddress,
        'eme_city' => $faker->city,
        'eme_state' => $faker->stateAbbr,
        'eme_zip' => $faker->postcode,
        'eme_homephone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'eme_cellphone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'alt_eme_relation' => $faker->numberBetween($min = 1, $max = 6),
        'alt_eme_name' => $faker->name,
        'alt_eme_address1' => $faker->streetAddress,
        'alt_eme_address2' => $faker->secondaryAddress,
        'alt_eme_city' => $faker->city,
        'alt_eme_state' => $faker->stateAbbr,
        'alt_eme_zip' => $faker->postcode,
        'alt_eme_homephone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'alt_eme_cellphone' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'wanders' => $faker->numberBetween($min = 1, $max = 3),
        'possiblelocations' => $faker->text($maxNbChars = 50)   ,
        'behaviorialhazards' => $faker->text($maxNbChars = 50)   ,
        'otherinfo' => $faker->text($maxNbChars = 50)   ,
        'primarylang' => $faker->languageCode,
        'secondarylang' => $faker->languageCode,
        'communicationmethod' => $faker->text($maxNbChars = 50)   ,
        'physicianname1' => $faker->name,
        'physicianphone1' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        'physicianname2' => $faker->name,
        'physicianphone2' => $faker->numberBetween($min = 1000000000, $max = mt_getrandmax()),
        //'disab' => , //array??
        'otherconditions' => $faker->text($maxNbChars = 50)   ,
        'medication' => $faker->text($maxNbChars = 50)   ,
        'medicalrequirements' => $faker->text($maxNbChars = 50)   ,
        'medicaldevices' => $faker->text($maxNbChars = 50)   ,
        'digitalsig' => $faker->name,
        'isdeleted' => false,
        'status' => 0,
    ];
});
