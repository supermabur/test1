<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer(['namaview1', 'namaview2'], 
        //                 'App\Http\ViewComposers\UserComposer'
        //                 );

        
        // view()->share('current_user', $user = \Auth::user());
        View::composer('*', 'App\Http\ViewComposers\UserComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
