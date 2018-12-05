<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dependent_id');
            $table->string('user_id');
            $table->string('fname');
            $table->string('middleinitial')->nullable();
            $table->string('lname');
            $table->string('nickname')->default('');
            $table->string('birthdate');
            $table->string('ethnicity1')->default('');
            $table->string('ethnicity2')->default('');
            //ethnicity table to allow for multiple
            $table->string('gender');
            $table->string('image_link')->default('');
            $table->string('haircolor')->default('');
            $table->string('eyecolor')->default('');
            $table->string('height')->default('');
            $table->string('weight')->default('');

            $table->string('disability')->default('');
            $table->string('identifyingfeatures')->default('');
            $table->string('idondependent')->default('');
            $table->string('approachsuggestions')->default('');

            //Home and Contact Information
            $table->binary('livealone')->nullable();
            $table->tinyInteger('typeofresidence')->nullable(); //type of residence
            $table->string('address1')->default('');
            $table->string('address2')->default('');
            $table->string('city')->default('');
            $table->string('state')->default('');
            $table->string('zip')->default('');

            $table->string('homephone')->default('');
            $table->string('cellphone')->default('');

            $table->string('sendtwocards')->nullable();
            $table->string('eme_name')->default('');
            $table->tinyInteger('eme_relation')->nullable();
            $table->string('eme_address1')->default('');
            $table->string('eme_address2')->default('');
            $table->string('eme_city')->default('');
            $table->string('eme_state')->default('');
            $table->string('eme_zip')->default('');

            $table->string('eme_homephone')->default('');
            $table->string('eme_cellphone')->default('');

            $table->string('alt_eme_name')->default('');
            $table->tinyInteger('alt_eme_relation')->nullable();
            $table->string('alt_eme_address1')->default('');
            $table->string('alt_eme_address2')->default('');
            $table->string('alt_eme_city')->default('');
            $table->string('alt_eme_state')->default('');
            $table->string('alt_eme_zip')->default('');

            $table->string('alt_eme_homephone')->default('');
            $table->string('alt_eme_cellphone')->default('');

            //Behaviorial Information
            $table->tinyInteger('wanders')->nullable();
            $table->string('possiblelocations')->default('');
            $table->string('behaviorialhazards')->default('');
            $table->string('otherinfo')->default('');

            //Communcation
            $table->string('primarylang')->default('');
            $table->string('secondarylang')->default('');
            $table->string('communicationmethod')->default('');

            //Medical Information
            $table->string('otherconditions')->default('');
            $table->string('physicianname1')->default('');
            $table->string('physicianphone1')->default('');
            $table->string('physicianname2')->default('');
            $table->string('physicianphone2')->default('');
            $table->string('medication')->default('');
            $table->string('medicalrequirements')->default('');
            $table->string('medicaldevices')->default('');
            $table->string('digitalsig')->default('');

            $table->binary('isdeleted')->nullable();
            $table->binary('step_zero')->nullable();
            $table->binary('step_one')->nullable();
            $table->binary('step_two')->nullable();
            $table->binary('step_three')->nullable();
            $table->binary('step_four')->nullable();
            $table->binary('step_five')->nullable();
            $table->integer('status')->nullable();
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
        Schema::drop('applications');
    }
}
