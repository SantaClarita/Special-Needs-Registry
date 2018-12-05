<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_space', function($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });
        Validator::extend('phone', function ($attribute, $value) {
            return preg_match('/^[(.-]?[0-9]{3}[)\s.-]?[\s]?[0-9]{3}[-\s.-]?[0-9]{4}/', $value);
        });
        Validator::extend('emecheck', function ($attribute, $value, $parameters) {
            dd($parameters);
            return preg_match('/^[(.]?[0-9]{3}[).]?[\s]?[0-9]{3}[-\s.]?[0-9]{4}/', $value);
        });
        Validator::extend('recaptcha','App\\Validators\\ReCaptcha@validate');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
