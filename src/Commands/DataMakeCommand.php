<?php namespace Kodebyraaet\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\AppNamespaceDetectorTrait;
use Kodebyraaet\Generators\GeneratorFactory;

class DataMakeCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data {name} {--seed} {--migration} {--models=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the a data folder with a model, repository, interface and service provider';

    /**
     * @var Generator
     */
    private $generator;

    /**
     * Create a new command instance.
     *
     * @return void
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

        // If the migration option is set, create a migration
        if ($this->option('migration')) {
            $this->call('make:migration', [
                'name' => 'Create_'.str_plural(strtolower($name)).'_table',
                '--create' => str_plural(strtolower($name))
            ]);
        }

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

        // If the seed option is set, create a seed
        if ($this->option('seed'))
            $this->generator->create('Seeder', $name, $this);

        // Create the model
        $this->generator->create('Model', $name, $this, $extraData);

        // Create the repository
        $this->generator->create('Repository', $name, $this, $extraData);

        // Create the repository interface
        $this->generator->create('RepositoryInterface', $name, $this);

        // Create the service provider
        $this->generator->create('Provider', $name, $this, $extraData);


        $this->comment("===================================================");
        $this->info("Add the following line to your providers in config:");
        $this->line($this->getAppNamespace().'Data\\'.$name.'\\'.$name.'ServiceProvider::class,');

        if ($this->option('seed')) {
            $this->comment("===================================================");
            $this->info('Add the following line to your DatabaseSeeder.php:');
            $this->line('$this->call('.$name.'TableSeeder::class);');
        }
    }
}
