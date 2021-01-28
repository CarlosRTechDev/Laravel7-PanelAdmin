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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //before: para definir una devolucion de una llamada que se ejecuta antes de todo
        Gate::before(function($user, $role){
            //retorna la verificacion de que si nuestro user tiene un rol
            //contains: determina si la coleccion contiene un elemento dado (rol-Administrador)
            return $user->tieneRol()->contains($role);
        });
    }
}
