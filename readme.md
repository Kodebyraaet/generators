# Kodebyraaet Generators for Laravel 5
--------------------

A collection of generators.

## Installation

Install composer dependency.

    composer require kodebyraaet/generators --dev

Add the provider in `config/app.php`.

    Kodebyraaet\Generators\GeneratorsServiceProvider::class

## Available Commands

| Command  | Description |
| ------------- | ------------- |
| php artisan make:data {name} | Create the a data folder with a model, repository, interface and service provider |
| php artisan make:data:model {name} | Create a new data model |
| php artisan make:data:repository {name} | Create a new data repository |
| php artisan make:data:interface {name} | Create a new data interface |
| php artisan make:data:provider {name} | Create a new data service provider |

    
    php artisan make:data:model {name}

## Example Usage

    php artisan make:data Project
    
  This will create the following files and folders:
  ``` 
  +-- App  
  |   +-- Data
  |      +-- Project
  |         +-- Contracts
  |            +-- ProjectInterface.php
  |         +-- Models
  |            +-- Project.php
  |         +-- Repositories
  |            +-- ProjectRepository.php
  |         +-- ProjectServiceProvider.php
  ```
