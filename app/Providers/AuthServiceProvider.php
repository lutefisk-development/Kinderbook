<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        // only users can edit own child
        Gate::define('parenting', function($user, $kid) {
            return $user->id == $kid->user_id;
        });

        // admin can overide all of this
        Gate::before(function($user, $ability) {
            if($user->is_admin()) {
                return true;
            }
        });
    }
}
