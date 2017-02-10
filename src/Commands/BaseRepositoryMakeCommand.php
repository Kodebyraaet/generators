<?php

namespace Kodebyraaet\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;
use Kodebyraaet\Generators\GeneratorFactory;

class BaseRepositoryMakeCommand extends Command
{
    use DetectsApplicationNamespace;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:base-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the base repository that is needed by the objects created by make:entity command';

    /**
     * @var GeneratorFactory
     */
    private $generator;

    /**
     * Create a new command instance.
     *
     * @param GeneratorFactory $generator
     */
    public function __construct(GeneratorFactory $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Create the base repository
        $this->generator->create('BaseRepository', $this);

        // Create the base repository interface
        $this->generator->create('BaseRepositoryInterface', $this);
    }
}
