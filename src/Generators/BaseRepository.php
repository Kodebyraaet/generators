<?php

namespace Kodebyraaet\Generators\Generators;

class BaseRepository extends BaseGenerator
{
    /**
     * The directory path
     * 
     * @return string
     */
    public function directory()
    {
        return app('path').DIRECTORY_SEPARATOR.'Entities';
    }

    /**
     * The filename
     *
     * @param string $name
     * @return string
     */
    public function filename($name = null)
    {
        return $this->directory() . '/Repository.php';
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
    }
}
