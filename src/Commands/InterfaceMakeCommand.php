<?php

namespace Kodebyraaet\Generators\Commands;

class InterfaceMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data:interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new data repository interface.';

    /**
     * Directory path.
     *
     * @return string
     */
    public function directory()
    {
        return app_path('Data/'.$this->name.'/Contracts');
    }

    /**
     * The filename
     * 
     * @return string
     */
    public function filename() 
    {
        return $this->directory() . "/{$this->name}Interface.php";
    }

    /**
     * Will generate the folders needed to make files
     * 
     */
    public function makeFolders()
    {
        if (!$this->filesystem->isDirectory(app_path('Data'))) {
            $this->filesystem->makeDirectory(app_path('Data'));
        }

        if (!$this->filesystem->isDirectory(app_path('Data/'.$this->name))) {
            $this->filesystem->makeDirectory(app_path('Data/'.$this->name));
        }

        if (!$this->filesystem->isDirectory($this->directory())) {
            $this->filesystem->makeDirectory($this->directory());
        }
    }
}
