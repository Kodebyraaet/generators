<?php namespace Kodebyraaet\Generators\Generators;

class RepositoryInterface extends BaseGenerator
{
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