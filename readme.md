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
| php artisan make:data Name [--seed] [--migration] | Create the a data folder with a model, repository, interface and service provider |
| php artisan make:data:model Name | Create a new data model |
| php artisan make:data:repository Name | Create a new data repository |
| php artisan make:data:interface Name | Create a new data interface |
| php artisan make:data:provider Name | Create a new data service provider |
| php artisan make:data:seeder Name | Create a new data seeder |

    
## Example Usage

    php artisan make:data Project --seed --migration
    
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
  +-- database
  |   +-- migrations
  |      +-- 2015_08_19_110000_Create_Projects_table.php
  |   +-- seeds
  |      +-- ProjectTableSeeder.php
  ```
