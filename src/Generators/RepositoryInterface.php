<?php

namespace Kodebyraaet\Generators\Generators;

class RepositoryInterface extends BaseGenerator
{
    /**
     * Directory path.
     *
     * @return string
     */
    public function directory()
    {
    	return app('path').DIRECTORY_SEPARATOR.'Entities'.DIRECTORY_SEPARATOR.$this->name.DIRECTORY_SEPARATOR.'Contracts';
    }

    /**
     * The filename
     *
     * @param string $name
     * @return string
     */
    public function filename($name = null) 
    {
        if ($name === null) {
            $name = $this->name;
        }

        return $this->directory() . '/'. $name . 'Interface.php';
    }

    /**
     * Will generate the folders needed to make files
     * 
     */
    public function makeFolders()
    {
        if (!$this->filesystem->isDirectory(app('path').DIRECTORY_SEPARATOR.'Entities')) {
            $this->filesystem->makeDirectory(app('path').DIRECTORY_SEPARATOR.'Entities');
        }

        if (!$this->filesystem->isDirectory(app('path').DIRECTORY_SEPARATOR.'Entities'.DIRECTORY_SEPARATOR.$this->name)) {
            $this->filesystem->makeDirectory(app('path').DIRECTORY_SEPARATOR.'Entities'.DIRECTORY_SEPARATOR.$this->name);
        }

        if (!$this->filesystem->isDirectory($this->directory())) {
            $this->filesystem->makeDirectory($this->directory());
        }
    }
}
