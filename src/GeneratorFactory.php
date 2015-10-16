<?php

namespace Kodebyraaet\Generators;

use Illuminate\Console\Command;
use Kodebyraaet\Generators\Generators\BaseGenerator;

class GeneratorFactory
{
    /**
     * Create and run a new generator
     * 
     * @param  string $generator The name of the generator to run
     * @param  Command $console
     * @param  string $name      The name of whatever we are creating
     * @param  array  $data      Any additional data
     * @return BaseGenerator
     */
    public function create($generator, Command $console, $name = null, $data = [])
    {
        $class = 'Kodebyraaet\\Generators\\Generators\\'.$generator;

        return with(app($class))->setConsole($console)->setData($data)->generate($name);
    }
}