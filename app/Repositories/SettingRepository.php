<?php

namespace App\Repositories;

use App\Setting;

class SettingRepository
{
    public function getAllSettings()
    {
        return Setting::all();
    }

    public function getSettingsWithEmaillists()
    {
        return Setting::with('emaillists.roles', 'emaillists.useremails')->get();
    }

    public function getSettingsWithID($id)
    {
        return Setting::with('emaillists.roles', 'emaillists.useremails')->where('id',$id)->get();
    }

    public function getEmailsWithSettingID($id)
    {
        $email_list_arr = array();
        $useremail_list_arr = array(); //contains specific recipient emails
        $userroleemail_list_arr = array(); //contains all user emails with the role in the email list

        //first error if setting has no emaillist assigned
        $settings = Setting::with('emaillists.roles', 'emaillists.useremails')->where('id',$id)->first();
        if (count($settings->emaillists) == 0)
            abort(202, 'There is no email list attached to this specific setting/action.');

        //get all
        $settings = Setting::with('emaillists.roles', 'emaillists.useremails')->where('id',$id)->get();

        foreach ($settings as $setting) {
            foreach ($setting->emaillists as $userlist) {
                foreach ($userlist->useremails as $index) {
                    array_push($useremail_list_arr, $index->email);
                }
            }
        }

        foreach ($settings as $setting) {
            foreach ($setting->emaillists as $emaillist) {
                foreach ($emaillist->roles as $role) {
                    foreach ($role->users as $user) {
                        array_push($userroleemail_list_arr, $user->email);
                    }
                }
            }
        }

        $email_list_arr = array_unique(array_merge($useremail_list_arr, $userroleemail_list_arr));

        if (empty($email_list_arr))
            abort(202, 'The email list is empty. This is because the current email list tied to this action has no email recipients.');
        
        //Could add a opt out from email list here.

        return $email_list_arr;
    }

    public function forSetting($setting)
    {
        return Setting::find($setting->id);
    }
}

