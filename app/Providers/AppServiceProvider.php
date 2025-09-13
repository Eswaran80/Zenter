<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->BindService();
        $this->BindRepository();
    }

    public function BindService(){
        $Services=[
            'Login'
        ];
        foreach($Services as $service){
        $interface="App\\Services\\{$service}\\{$service}Interface";
        $implementation="App\\Services\\{$service}\\{$service}Service";
        $this->app->bind($interface,$implementation);
        }
       
    }
    public function BindRepository(){
        $repositories=[
            'Login'
        ];
        foreach($repositories as $repository){
            $interface="App\\Repositories\\{$repository}\\{$repository}Contract";
            $implemetation="App\\Repositories\\{$repository}\\{$repository}Eloquent";
            $this->app->bind($interface,$implemetation);

        }

    }

    public function boot(): void
    {
        //
    }
        }