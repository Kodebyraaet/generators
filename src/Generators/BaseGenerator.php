<?php

namespace Kodebyraaet\Generators\Generators;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Console\DetectsApplicationNamespace;
use Kodebyraaet\Generators\StubParsers\StubParser;

abstract class BaseGenerator
{
    use DetectsApplicationNamespace;

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
     * The console instance passed from the ran command
     * @var Command
     */
    protected $console;

    /**
     * An array of any additional data that should be sent to the parser
     * @var Array
     */
    protected $data;

    /**
     * Constructor
     *
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->parser     = $this->parser();
    }

    /**
     * Will set the Console instance
     *
     * @param  Command $console
     * @return $this
     */
    public function setConsole(Command $console)
    {
        $this->console = $console;

        return $this;
    }

    /**
     * Will set any additional data that will be sent to the parser
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Directory path.
     *
     */
    abstract public function directory();

    /**
     * File name.
     *
     * @param string $name
     */
    abstract public function filename($name = null);

    /**
     * Will generate the folders needed to make files
     * 
     */
    abstract public function makeFolders();

    /**
     * A function that will be ran after generating the original file
     * 
     */
    public function afterGenerate()
    {

    }

    /**
     * The parser to use.
     *
     * @return StubParser
     */
    protected function parser()
    {
        $parser = class_basename(get_called_class()).'StubParser';
        $parser = 'Kodebyraaet\\Generators\\StubParsers\\'.$parser;

        return app($parser);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function stub()
    {
        $slug = snake_case(class_basename(get_called_class()));
        $slug = str_replace('_', '-', $slug);

        return __DIR__ . "/../Stubs/{$slug}.stub";
    }

    /**
     * Detect the namespace with the given directory.
     *
     * @return string
     */
    protected function detectNamespace()
    {
        if (!str_contains($this->directory(), app_path())) {
            return null;
        }

        $path  = str_replace(app_path(), '', $this->directory());
        $class = rtrim($this->getAppNamespace(), '\\') . str_replace('/', '\\', $path);

        return $class;
    }

    /**
     * Will run the parser, create necessary folders and files
     *
     * @param string $name
     */
    protected function createFile($name = null)
    {
        if ($name === null) {
            $name = $this->name;
        }

        $file = $this->filename($name);

        $content = $this->parser
            ->stub($this->stub())
            ->name($name)
            ->setClassNamespace($this->detectNamespace())
            ->setData($this->data)
            ->parse();

        if ($this->filesystem->exists($file)) {
            $this->console->error("The file {$file} already exists.");
            return;
        }

        // Make folders if necessary
        $this->makeFolders();

        // Create the file
        $this->filesystem->put($file, $content);
        $this->console->info("Generated {$file}");
    }

    /**
     * Generate the file
     *
     * @param string $name
     */
    public function generate($name)
    {
        $this->name = $name;
        $this->createFile($this->name);
        $this->afterGenerate();
    }
}
