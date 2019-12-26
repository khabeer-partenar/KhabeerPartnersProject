<?php

namespace Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Users\Entities\Delegate;
use Modules\Users\Observers\DelegateObserver;

class DelegateServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Delegate::observe(DelegateObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
