<?php

namespace Kodebyraaet\Generators;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('command.kodebyraaet.data', function ($app) {
            return $app[Commands\EntityMakeCommand::class];
        });

        $this->app->singleton('command.kodebyraaet.repository', function ($app) {
            return $app[Commands\BaseRepositoryMakeCommand::class];
        });

        $this->commands('command.kodebyraaet.data');
        $this->commands('command.kodebyraaet.repository');
    }
}
