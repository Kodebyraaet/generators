<?php namespace Kodebyraaet\Generators\Actions;

use Illuminate\Console\Command;

class Migration {

    static public function create($name, Command $console)
    {
        $console->call('make:migration', [
            'name' => 'Create_'.str_plural($name).'_table',
            '--create' => strtolower(str_plural($name))
        ]);
    }

}