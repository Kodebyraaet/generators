<?php namespace Kodebyraaet\Generators;

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
            return $app[Commands\DataMakeCommand::class];
        });

        $this->commands('command.kodebyraaet.data');
    }
}
