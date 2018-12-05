<?php

namespace App\Http\Controllers\SettingManagement;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Gate;
use Auth;
use Log;

use App\Setting;
use App\Emaillist;

use App\Repositories\SettingRepository;
use App\Repositories\EmaillistRepository;

class SettingController extends Controller
{

    public function __construct(SettingRepository $settings, EmaillistRepository $emaillists)
    {
        $this->middleware('auth');
        $this->settings = $settings;
        $this->emaillists = $emaillists;
    }

    public function index()
    {
        if (policy(Setting::class)->manageSetting(Auth::user())) {
            return view('settings.index', [ 
                    'settings' => $this->settings->getSettingsWithEmaillists(),
                ]); 
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function edit(Request $request, Setting $setting)
    {  
        if (policy(Setting::class)->manageSetting(Auth::user())) {
            return view('settings.edit', [
                'emaillists' => $this->emaillists->getAllEmaillists(), 
                'settingemaillist' => $this->settings->forSetting($setting)->emaillists,
                'setting' => $setting,
            ]);
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function update(Request $request, Setting $setting)
    {       
        if (policy(Setting::class)->manageSetting(Auth::user())) {
            $this->validate($request, [ 
                'setting.*' => 'max:255|exists:emaillists,id',
            ]);
            if ($request->input('setting') == null)
                $setting->emaillists()->sync([]); 
            else 
                $setting->emaillists()->sync($request->input('setting'));
            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has edited setting "'.$setting->name.'"');
            $request->session()->flash('status', 'Settings "'.$setting->name. '" was updated successfully!');
            return redirect('/settings');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }

    public function delete(Request $request, Setting $setting, Emaillist $emaillist)
    {
        if (policy(Setting::class)->manageSetting(Auth::user())) {
            $setting->emaillists()->detach($emaillist);

            Log::info(Auth::user()->fname.' '.Auth::user()->lname.' ('.Auth::user()->email.') has removed email list "'.$emaillist->name.'" from setting "'.$setting->name.'"');
            $request->session()->flash('status', 'Email List "'.$emaillist->name. '" was removed successfully from "'.$setting->name.'" settings!');
            return redirect('/settings');
        }
        abort(401, 'You are not authorized to view or preform that action.');
    }
}
