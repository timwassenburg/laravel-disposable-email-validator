<?php

namespace TimWassenburg\DisposableEmailValidator;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Validator;

class DisposableEmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/disposable-email-validator.php', 'disposable-email');
    }

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'disposable-email');
        $this->DisposableEmailValidator();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/disposable-email-validator.php' => config_path('disposable-email-validator.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/disposable-email'),
            ], 'translations');
        }
    }

    public function DisposableEmailValidator()
    {
        Validator::extend('DisposableEmail', function ($attribute, $value) {
            $disposableDomains = config('disposable-email.domains');
            $value = explode('@', strtolower($value));
            $inputDomain = array_pop($value);

            return ! in_array($inputDomain, $disposableDomains);
        }, trans('disposable-email::validation.disposable_email_validation_message'));
    }
}
