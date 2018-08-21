<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Passport::routes();

        Passport::tokensCan([

            // Permisos de usuario entrenador 

            'crear' => 'Puede crear elementos como, equipos y noticias',

            'actualizar' => 'Puede actualizar informacion de equipos y noticas',

            'eliminar' => 'Puede eliminar, sus  equipos y noticias',

            
            // Permiso usuario normal y entrenador

            'ver' => 'Puede ver todos los elementos como usuarios, equipos, y noticias', 
            
            'actualizar-perfil' => 'actualizar info de perfil',

            'crud-comentarios' => 'gestion de comentarios',


        ]);

        //
    }
}
