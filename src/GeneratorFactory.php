<?php namespace Kodebyraaet\Generators;

class GeneratorFactory
{
    /**
     * Create and run a new generator
     * 
     * @param  string $generator The name of the generator to run
     * @param  string $name      The name of whatever we are creating
     * @param  Console $console  
     * @param  array  $data      Any additional data
     * @return BaseGenerator
     */
    public function create($generator, $name, $console, $data = [])
    {
        $class = 'Kodebyraaet\\Generators\\Generators\\'.$generator;

        return with(app($class))->setConsole($console)->setData($data)->generate($name);
    }
}