<?php

namespace Packages\Payments\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Packages\Payments\Console\Commands\ProcessWithdrawals;
use Packages\Payments\Console\Kernel;
use Packages\Payments\ViewComposers\Backend\DashboardComposer;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $packageBaseDir = __DIR__ . '/../../';
        // load migrations
        $this->loadMigrationsFrom($packageBaseDir . 'database/migrations');
        // load routes
        $this->loadRoutesFrom($packageBaseDir . 'routes/web.php');
        // load views fom current package
        $this->loadViewsFrom($packageBaseDir . 'resources/views', 'payments');
        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                ProcessWithdrawals::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $packageBaseDir = __DIR__ . '/../../';
        // load package config
        $this->mergeConfigFrom(
            $packageBaseDir . 'config/config.php', 'payments'
        );

        // Bind a custom Kernel class to the IoC
        $this->app->singleton(Kernel::class, function($app) {
            $dispatcher = $app->make(Dispatcher::class);
            return new Kernel($app, $dispatcher);
        });
        $this->app->make(Kernel::class);
    }
}