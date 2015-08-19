<?php

namespace Kodebyraaet\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\AppNamespaceDetectorTrait;

abstract class GeneratorCommand extends Command
{
    use AppNamespaceDetectorTrait;

    /**
     * Filesystem instance.
     *
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * The name of the class we are generating for
     * @var string
     */
    protected $name;

    /**
     * Create a new command instance.
     *
     * @return RepositoryMakeCommand
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->parser     = $this->parser();
    }

    /**
     * Directory path.
     *
     */
    abstract public function directory();

    /**
     * Will generate the folders needed to make files
     * 
     */
    abstract public function makeFolders();

    /**
     * The filename of the file that will be created
     * 
     */
    abstract public function filename();

    /**
     * The parser to use.
     *
     * @return StubParser
     */
    protected function parser()
    {
        $class  = class_basename(get_called_class());

        $parser = str_replace('MakeCommand', 'StubParser', $class);
        $parser = "Kodebyraaet\\Generators\\StubParsers\\{$parser}";

        return app($parser);
    }

    /**
     * Get the stub file for the generator.
     *
     */
    protected function stub()
    {
        $class  = class_basename(get_called_class());
        $slug = snake_case(str_replace('MakeCommand', '', $class));
        $slug = str_replace('_', '-', $slug);

        return __DIR__ . "/stubs/{$slug}.stub";
    }

    /**
     * Detect the namespace with the given directory.
     *
     * @return string
     */
    protected function detectNamespace()
    {
        if(! str_contains($this->directory(), app_path())) {
            return null;
        }

        $path  = str_replace(app_path(), '', $this->directory());
        $class = rtrim($this->getAppNamespace(), '\\') . str_replace('/', '\\', $path);

        return $class;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->name = $this->argument('name');
        $file = $this->filename();

        $content = $this->parser
            ->stub($this->stub())
            ->name($this->name)
            ->setClassNamespace($this->detectNamespace())
            ->parse();

        if ($this->filesystem->exists($file)) {
            $this->error("The file {$file} already exists.");
            return;
        }

        // Make folders if neccecary
        $this->makeFolders();

        // Create the file
        $this->filesystem->put($file, $content);
        $this->info("Generated {$file}");
    }
}
