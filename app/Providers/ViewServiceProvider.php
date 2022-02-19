<?php

namespace App\Providers;
use App\View\Composers\CartComposer;
use App\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }


    public function boot()
    {
        View::composer('head',MenuComposer::class);
        View::composer('cart',CartComposer::class);
    }
}
