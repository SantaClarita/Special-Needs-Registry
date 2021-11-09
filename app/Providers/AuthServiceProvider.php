<?php

namespace App\Providers;

use App\Participant;
use App\User;
use App\Role;
use App\Emaillist;
use App\Setting;
use App\Log;

use App\Policies\ParticipantPolicy;
use App\Policies\RolePermissionPolicy;
use App\Policies\UserPolicy;
use App\Policies\EmaillistPolicy;
use App\Policies\SettingPolicy;
use App\Policies\LogPolicy;


use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Participant::class => ParticipantPolicy::class,
        Role::class => RolePermissionPolicy::class,
        Permission::class => RolePermissionPolicy::class,
        User::class => UserPolicy::class,
        Emaillist::class => EmaillistPolicy::class,
        Setting::class => SettingPolicy::class,
        Log::class => LogPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
    }
}
