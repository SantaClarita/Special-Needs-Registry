<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            //Special Needs Individual Information
            $table->increments('id');
            $table->integer('user_id');
            $table->string('fname');
            $table->string('middleinitial')->nullable();
            $table->string('lname');
            $table->string('nickname')->nullable();
            $table->string('birthdate');
            $table->string('ethnicity1')->nullable();
            $table->string('ethnicity2')->nullable();
            //ethnicity table to allow for multiple
            $table->string('gender');
            $table->string('image_link')->nullable();
            $table->string('haircolor')->nullable();
            $table->string('eyecolor')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();

            $table->string('disability')->nullable();
            $table->string('identifyingfeatures')->nullable();
            $table->string('idonparticipant')->nullable();
            $table->string('approachsuggestions')->nullable();

            //Home and Contact Information
            $table->binary('livealone')->nullable();
            $table->tinyInteger('typeofresidence')->nullable(); //type of residence
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();

            $table->string('homephone')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('eme_name')->nullable();
            $table->tinyInteger('eme_relation')->nullable();
            $table->string('eme_address1')->nullable();
            $table->string('eme_address2')->nullable();
            $table->string('eme_city')->nullable();
            $table->string('eme_state')->nullable();
            $table->string('eme_zip')->nullable();

            $table->string('eme_homephone')->nullable();
            $table->string('eme_cellphone')->nullable();

            $table->string('alt_eme_name')->nullable();
            $table->tinyInteger('alt_eme_relation')->nullable();
            $table->string('alt_eme_address1')->nullable();
            $table->string('alt_eme_address2')->nullable();
            $table->string('alt_eme_city')->nullable();
            $table->string('alt_eme_state')->nullable();
            $table->string('alt_eme_zip')->nullable();

            $table->string('alt_eme_homephone')->nullable();
            $table->string('alt_eme_cellphone')->nullable();

            //Behaviorial Information
            $table->tinyInteger('wanders')->nullable();
            $table->string('possiblelocations')->nullable();
            $table->string('behaviorialhazards')->nullable();
            $table->string('otherinfo')->nullable();

            //Communcation
            $table->string('primarylang')->nullable();
            $table->string('secondarylang')->nullable();
            $table->string('communicationmethod')->nullable();

            //Medical Information
            $table->string('otherconditions')->nullable();
            $table->string('physicianname1')->nullable();
            $table->string('physicianphone1')->nullable();
            $table->string('physicianname2')->nullable();
            $table->string('physicianphone2')->nullable();
            $table->string('medication')->nullable();
            $table->string('medicalrequirements')->nullable();
            $table->string('medicaldevices')->nullable();
            $table->string('digitalsig')->nullable();

            $table->integer('status')->default(0);
            $table->binary('isdeleted')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('participants');
    }
}
