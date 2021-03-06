<?php

namespace Kodebyraaet\Generators\Generators;

class Provider extends BaseGenerator
{
    /**
     * The Directory path.
     *
     * @return string
     */
    public function directory()
    {
        return app('path').DIRECTORY_SEPARATOR.'Entities'.DIRECTORY_SEPARATOR.$this->name;
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

        return $this->directory() . '/'. $name . 'ServiceProvider.php';
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
    }
}