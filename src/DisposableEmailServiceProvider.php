<?php

namespace TimWassenburg\DisposableEmailValidator;

use Illuminate\Support\ServiceProvider;
use TimWassenburg\DisposableEmailValidator\Services\DisposableEmailService;
use Validator;

class DisposableEmailServiceProvider extends ServiceProvider
{
    protected $disposableEmailService;

    public function __construct($app)
    {
        $this->disposableEmailService = new DisposableEmailService;

        parent::__construct($app);
    }

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
        $this->registerDisposableEmailRule();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/disposable-email-validator.php' => config_path('disposable-email-validator.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/disposable-email'),
            ], 'translations');
        }
    }

    public function registerDisposableEmailRule()
    {
        Validator::extend('DisposableEmail', function ($attribute, $email) {
            $domain = $this->disposableEmailService->getDomainFromEmailAddress($email);

            return $this->disposableEmailService->isDisposableDomain($domain);
        }, trans('disposable-email::validation.disposable_email_validation_message'));
    }


}
