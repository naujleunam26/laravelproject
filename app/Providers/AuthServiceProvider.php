<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\RolePolicy;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Otras políticas
        User::class => RolePolicy::class,
    ];

    public function boot()
{
    $this->registerPolicies();

    Gate::define('isAdmin', function ($user) {
        return $user->role === 'admin'; // Asegúrate de que 'role' sea el atributo correcto
    });
}
}
