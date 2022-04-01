<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        include(__DIR__."/../functions.php");
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            return Auth::guard("admin")->check();
        });
        Blade::if('teacher', function () {
            return Auth::guard("teacher")->check();
        });
        Blade::if('student', function () {
            return Auth::guard("student")->check();
        });
        Blade::if("started",function($exam){
           return strtotime($exam->started_at) < strtotime(now());
        });
        Blade::if("ended",function($exam){
           return strtotime($exam->ended_at) < strtotime(now());
        });
       
    }
}
