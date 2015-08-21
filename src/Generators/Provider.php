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
        return app_path('Data/'.$this->name);
    }

    /**
     * The filename
     * 
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
        if (!$this->filesystem->isDirectory(app_path('Data'))) {
            $this->filesystem->makeDirectory(app_path('Data'));
        }

        if (!$this->filesystem->isDirectory(app_path('Data/'.$this->name))) {
            $this->filesystem->makeDirectory(app_path('Data/'.$this->name));
        }
    }
}