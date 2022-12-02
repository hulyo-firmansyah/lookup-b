<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /**
         * This require client secret
         * https://stackoverflow.com/questions/39572957/laravel-passport-password-grant-client-authentication-failed
         */
        // Passport::hashClientSecrets();

        /** @var CachesRoutes $app */
        $app = $this->app;
        if (!$app->routesAreCached()) {
            Passport::routes();
        }
    }
}
