<?php

namespace Kodebyraaet\Generators\Generators;

class Seeder extends BaseGenerator
{
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
     * @param string $name
     * @return string
     */
    public function filename($name = null) 
    {
        if ($name === null) {
            $name = $this->name;
        }

        return $this->directory() . '/' . $name .'TableSeeder.php';
    }

    /**
     * Will generate the folders needed to make files
     * 
     */
    public function makeFolders()
    {

    }
}
