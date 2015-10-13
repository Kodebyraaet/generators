# Kodebyraaet Generators for Laravel 5

A collection of generators.

## Installation

Install composer dependency.

    composer require kodebyraaet/generators --dev

Add the provider in `config/app.php`.

    Kodebyraaet\Generators\GeneratorsServiceProvider::class

## Available Commands

| Command  | Description |
| ------------- | ------------- |
| php artisan make:entitiy Name [--models={Additional models}] [--seed] [--migration] | Create the a entity folder with a model, repository, interface and service provider |
| php artisan make:base-repository | Create the base repository that is needed by the objects created by make:entity command, this should only be ran once |

    
## Example Usage

    php artisan make:entity Project --models=Person,Job --seed --migration
    
  This will create the following files and folders:
  ``` 
  +-- App  
  |   +-- Entities
  |      +-- Project
  |         +-- Contracts
  |            +-- ProjectInterface.php
  |         +-- Models
  |            +-- Project.php
  |            +-- Person.php
  |            +-- Job.php
  |         +-- Repositories
  |            +-- ProjectRepository.php
  |         +-- ProjectServiceProvider.php
  +-- database
  |   +-- migrations
  |      +-- 2015_08_19_110000_Create_Projects_table.php
  |   +-- seeds
  |      +-- ProjectTableSeeder.php
  ```
