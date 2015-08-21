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
| php artisan make:data Name [--models={Additional models}] [--seed] [--migration] | Create the a data folder with a model, repository, interface and service provider |

    
## Example Usage

    php artisan make:data Project --models=Person,Job --seed --migration
    
  This will create the following files and folders:
  ``` 
  +-- App  
  |   +-- Data
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
