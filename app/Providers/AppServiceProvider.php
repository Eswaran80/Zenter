<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
            'Login',
            'User'
        ];
        foreach($Services as $service){
        $interface="App\\Services\\{$service}\\{$service}Interface";
        $implementation="App\\Services\\{$service}\\{$service}Service";
        $this->app->bind($interface,$implementation);
        }
       
    }
    public function BindRepository(){
        $repositories=[
            'Login',
            'User'
        ];
        foreach($repositories as $repository){
            $interface="App\\Repositories\\{$repository}\\{$repository}Contract";
            $implemetation="App\\Repositories\\{$repository}\\{$repository}Eloquent";
            $this->app->bind($interface,$implemetation);

        }

    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
        }