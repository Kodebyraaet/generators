<?php

namespace Kodebyraaet\Generators\Commands;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data:model {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new data model.';

    /**
     * Directory path.
     *
     * @return string
     */
    public function directory()
    {
        return app_path('Data/'.$this->name.'/Models');
    }

    /**
     * The filename
     * 
     * @return string
     */
    public function filename() 
    {
        return $this->directory() . "/{$this->name}.php";
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
