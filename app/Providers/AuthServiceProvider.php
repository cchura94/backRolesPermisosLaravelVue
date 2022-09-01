<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // $user, $permiso
        // 56,    viewAny_user
        Gate::before(function($user, $permiso){
            // verificar si el usuario tiene el permiso manage_all
            if($user->permisos()->contains("manage_all")){
                return true;
            }

            // ["read_user", "create_user", "store_user"]
            return $user->permisos()->contains($permiso);
            
        });
        
    }
}
