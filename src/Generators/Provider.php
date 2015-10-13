<?php namespace Kodebyraaet\Generators\Generators;

class Provider extends BaseGenerator
{
    /**
     * The Directory path.
     *
     * @return string
     */
    public function directory()
    {
        return app_path('Entities/'.$this->name);
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
        if (!$this->filesystem->isDirectory(app_path('Entities'))) {
            $this->filesystem->makeDirectory(app_path('Entities'));
        }

        if (!$this->filesystem->isDirectory(app_path('Entities/'.$this->name))) {
            $this->filesystem->makeDirectory(app_path('Entities/'.$this->name));
        }
    }
}