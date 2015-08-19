<?php

namespace Kodebyraaet\Generators\Commands;

use Illuminate\Console\Command;

class DataMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data {name}';

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

        $this->call('make:data:model', ['name' => $name]);
        $this->call('make:data:repository', ['name' => $name]);
        $this->call('make:data:interface', ['name' => $name]);
        $this->call('make:data:provider', ['name' => $name]);
    }
}
