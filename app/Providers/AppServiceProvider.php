<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //en esta funcion que hemos creado es para que cada vez que se crea una consulta a la base de datos se utiliza 
        //esta y ademas podemos pedirle cualquier cosa , como que se muestre en log las consultas o  guardar ficheros etc,..


        Paginator::useBootstrap();
        DB::listen(function($query){
            // $sql = $query->sql;
            // $bindings = $query->bindings;
            // $time = $query->time;

        });


        ;
    }
}
