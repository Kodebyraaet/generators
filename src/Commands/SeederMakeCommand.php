<?php

namespace Kodebyraaet\Generators\Commands;

class SeederMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data:seeder {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new data seeder.';

    /**
     * Directory path.
     *
     * @return string
     */
    public function directory()
    {
        return base_path('database/seeds');
    }

    /**
     * The filename
     * 
     * @return string
     */
    public function filename() 
    {
        return $this->directory() . "/{$this->name}TableSeeder.php";
    }

    /**
     * Will generate the folders needed to make files
     * 
     */
    public function makeFolders()
    {

    }
}
