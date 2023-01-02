<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class
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

        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        /** @var CachesRoutes $app */
        $app = $this->app;
        if (!$app->routesAreCached()) {
            Passport::routes();
        }

        Gate::define('view-users', function ($user) {
            return $user->isAdmin() ? false : true;
        });
        Gate::define('view-user', [UserPolicy::class, 'view']);
        // Gate::define('view-user', function ($auth, $user) {
        //     dd($auth->id, $user->id);
        //     if ($auth->isAdmin()) {
        //         return $auth->id === $user->id;
        //     }

        //     return true;
        // });
    }
}
