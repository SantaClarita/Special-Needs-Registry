<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwPartipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_participants AS
                select `participants`.`id` AS `id`,`participants`.`user_id` AS `user_id`,`participants`.`fname` AS `fname`,`participants`.`lname` AS `lname`,`participants`.`nickname` AS `nickname`,`participants`.`middleinitial` AS `middleinitial`,`participants`.`birthdate` AS `birthdate`,`participants`.`ethnicity1` AS `ethnicity1`,`participants`.`gender` AS `gender`,`participants`.`image_link` AS `image_link`,`participants`.`haircolor` AS `haircolor`,`participants`.`eyecolor` AS `eyecolor`,`participants`.`height` AS `height`,`participants`.`weight` AS `weight`,`participants`.`disability` AS `disability`,`participants`.`identifyingfeatures` AS `identifyingfeatures`,`participants`.`idonparticipant` AS `idonparticipant`,`participants`.`approachsuggestions` AS `approachsuggestions`,`participants`.`typeofresidence` AS `typeofresidence`,`participants`.`livealone` AS `livealone`,`participants`.`address1` AS `address1`,`participants`.`address2` AS `address2`,`participants`.`city` AS `city`,`participants`.`state` AS `state`,`participants`.`zip` AS `zip`,`participants`.`homephone` AS `homephone`,`participants`.`cellphone` AS `cellphone`,`participants`.`eme_relation` AS `eme_relation`,`participants`.`eme_name` AS `eme_name`,`participants`.`eme_address1` AS `eme_address1`,`participants`.`eme_address2` AS `eme_address2`,`participants`.`eme_city` AS `eme_city`,`participants`.`eme_state` AS `eme_state`,`participants`.`eme_zip` AS `eme_zip`,`participants`.`eme_homephone` AS `eme_homephone`,`participants`.`eme_cellphone` AS `eme_cellphone`,`participants`.`alt_eme_relation` AS `alt_eme_relation`,`participants`.`alt_eme_name` AS `alt_eme_name`,`participants`.`alt_eme_address1` AS `alt_eme_address1`,`participants`.`alt_eme_address2` AS `alt_eme_address2`,`participants`.`alt_eme_city` AS `alt_eme_city`,`participants`.`alt_eme_state` AS `alt_eme_state`,`participants`.`alt_eme_zip` AS `alt_eme_zip`,`participants`.`alt_eme_homephone` AS `alt_eme_homephone`,`participants`.`alt_eme_cellphone` AS `alt_eme_cellphone`,`participants`.`wanders` AS `wanders`,`participants`.`possiblelocations` AS `possiblelocations`,`participants`.`behaviorialhazards` AS `behaviorialhazards`,`participants`.`otherinfo` AS `otherinfo`,`participants`.`primarylang` AS `primarylang`,`participants`.`secondarylang` AS `secondarylang`,`participants`.`communicationmethod` AS `communicationmethod`,`participants`.`otherconditions` AS `otherconditions`,`participants`.`physicianname1` AS `physicianname1`,`participants`.`physicianphone1` AS `physicianphone1`,`participants`.`physicianname2` AS `physicianname2`,`participants`.`physicianphone2` AS `physicianphone2`,`participants`.`medication` AS `medication`,`participants`.`medicalrequirements` AS `medicalrequirements`,`participants`.`medicaldevices` AS `medicaldevices`,`participants`.`digitalsig` AS `digitalsig`,`participants`.`isdeleted` AS `isdeleted`,`participants`.`created_at` AS `created_at`,`participants`.`updated_at` AS `updated_at`,`participants`.`deleted_at` AS `deleted_at`,`participants`.`ethnicity2` AS `ethnicity2`,`participants`.`status` AS `status`,timestampdiff(YEAR,`participants`.`birthdate`,curdate()) AS `age` from `participants`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vw_participants');
    }
}
