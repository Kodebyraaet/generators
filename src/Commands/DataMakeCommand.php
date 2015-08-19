<?php

namespace Kodebyraaet\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Kodebyraaet\Generators\Actions\Migration;

class DataMakeCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data {name} {--seed} {--migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the a data folder with a model, repository, interface and service provider';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        if($this->option('migration'))
            Migration::create($name, $this);

        if($this->option('seed'))
            $this->call('make:data:seeder', ['name' => $name]);

        $this->call('make:data:model', ['name' => $name]);
        $this->call('make:data:repository', ['name' => $name]);
        $this->call('make:data:interface', ['name' => $name]);
        $this->call('make:data:provider', ['name' => $name]);



        $this->comment("===================================================");
        $this->info("Add the following line to your providers in config:");


        $this->line($this->getAppNamespace().'Data\\'.$name.'\\'.$name.'ServiceProvider::class,');

        if($this->option('seed')) {
            $this->comment("===================================================");
            $this->info('Add the following line to your DatabaseSeeder.php:');
            $this->line('$this->call('.$name.'TableSeeder::class);');
        }
    }
}
