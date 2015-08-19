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
        $this->app->singleton('command.kodebyraaet.repository', function ($app) {
            return $app[Commands\RepositoryMakeCommand::class];
        });

        $this->app->singleton('command.kodebyraaet.interface', function ($app) {
            return $app[Commands\InterfaceMakeCommand::class];
        });

        $this->app->singleton('command.kodebyraaet.model', function ($app) {
            return $app[Commands\ModelMakeCommand::class];
        });

        $this->app->singleton('command.kodebyraaet.provider', function ($app) {
            return $app[Commands\ProviderMakeCommand::class];
        });

        $this->app->singleton('command.kodebyraaet.data', function ($app) {
            return $app[Commands\DataMakeCommand::class];
        });

        $this->app->singleton('command.kodebyraaet.seeder', function ($app) {
            return $app[Commands\SeederMakeCommand::class];
        });

        $this->commands('command.kodebyraaet.repository');
        $this->commands('command.kodebyraaet.interface');
        $this->commands('command.kodebyraaet.model');
        $this->commands('command.kodebyraaet.provider');
        $this->commands('command.kodebyraaet.data');
        $this->commands('command.kodebyraaet.seeder');
    }
}
