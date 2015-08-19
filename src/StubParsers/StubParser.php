<?php

namespace Kodebyraaet\Generators\StubParsers;

use Illuminate\Console\AppNamespaceDetectorTrait;

abstract class StubParser
{
    use AppNamespaceDetectorTrait;

    /**
     * Load the stub to be used
     *
     * @param  string  $stub
     * @return RepositoryStubParser
     */
    public function stub($stub)
    {
        $this->stub = $stub;

        return $this;
    }

    /**
     * Load the name to be made.
     *
     * @return RepositoryStubParser
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the namespace
     *
     * @param  string  $namespace
     * @return StubParser
     */
    public function setClassNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Parse the stub given.
     *
     * @return string
     */
    public function parse()
    {
        $content = file_get_contents($this->stub);

        foreach ($this->functions() as $function) {
            $replacement = call_user_func_array([$this, $function], []);
            $search      = '{' . snake_case($function) . '}';

            $content = str_replace($search, $replacement, $content);
        }

        return $content;
    }

    /**
     * Get all the placeholders.
     *
     * @return array
     */
    protected function functions()
    {
        $matches = [];
        $pattern = '/{(?<placeholders>.*?)}/';
        $subject = file_get_contents($this->stub);

        preg_match_all($pattern, $subject, $matches);

        $functions = array_unique($matches['placeholders']);

        array_walk($functions, function (&$function) {
            $function = camel_case($function);
        });

        return $functions;
    }

/*
|--------------------------------------------------------------------------
| Default Stub Parser Functons
|--------------------------------------------------------------------------
|
| Here are the default stub parsers.
|
*/
    /**
     * Get the application namespace and trim the slashes.
     *
     * @return string
     */
    public function appNamespace()
    {
        return rtrim($this->getAppNamespace(), '\\\\');
    }

    /**
     * Get the class namespace.
     *
     * @return string
     */
    public function classNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get the file name provided.
     *
     * @return string
     */
    public function filename()
    {
        return $this->name;
    }

    /**
     * Get the model name.
     * 
     * @return string
     */
    public function model()
    {
        return $this->name;
    }
}
