<?php

namespace Kodebyraaet\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Kodebyraaet\Generators\GeneratorFactory;

class EntityMakeCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity {name} {--seed} {--migration} {--models=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the an entity folder with a model, repository, interface and service provider';

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
        $name = str_singular(studly_case($this->argument('name')));
        $extraData = [];

        // If the models option is set, make it an array of models
        if ($this->option('models')) {
            if (strpos($this->option('models'), ',') !== false) {
                $extraData['extraModels'] = explode(',', $this->option('models'));
            } else {
                $extraData['extraModels'] = [$this->option('models')];
            }

            foreach ($extraData['extraModels'] as $key => &$model) {
                $model = str_singular(studly_case($model));
                if ($model == $name) {
                    unset($extraData['extraModels'][$key]);
                }
            }       
        }

        // If the migration option is set, create a migration
        if ($this->option('migration')) {
            $this->call('make:migration', [
                'name' => 'Create_'.str_plural(strtolower($name)).'_table',
                '--create' => str_plural(strtolower($name))
            ]);

            // If any extra models are being created, make migrations for them aswell
            if (isset($extraData['extraModels']) && count($extraData['extraModels'])) {
                foreach ($extraData['extraModels'] as $entry) {
                    $this->call('make:migration', [
                        'name' => 'Create_'.str_plural(strtolower($entry)).'_table',
                        '--create' => str_plural(strtolower($entry))
                    ]);
                }
            }
        }

        // If the seed option is set, create a seed
        if ($this->option('seed'))
            $this->generator->create('Seeder', $this, $name);

        // Create the model
        $this->generator->create('Model', $this, $name, $extraData);

        // Create the repository
        $this->generator->create('Repository', $this, $name, $extraData);

        // Create the repository interface
        $this->generator->create('RepositoryInterface', $this, $name);

        // Create the service provider
        $this->generator->create('Provider', $this, $name, $extraData);

        // Post info about seed to console
        if ($this->option('seed')) {
            $this->comment("===================================================");
            $this->info('Add the following line to your DatabaseSeeder.php:');
            $this->line('$this->call('.$name.'TableSeeder::class);');
        }
    }
}
