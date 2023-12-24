<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('product_create', fn (User $user) => $user->is_admin);
        Gate::define('product_edit', fn (User $user) => $user->is_admin);
        Gate::define('product_delete', fn (User $user) => $user->is_admin);

        Gate::define('user_index', fn (User $user) => $user->is_admin);
        Gate::define('user_edit', fn (User $user) => $user->is_admin);
        Gate::define('user_delete', fn (User $user) => $user->is_admin);
    }
}
