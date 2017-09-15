# Monarch:  Laravel Migrations from Locations

[![Software License][ico-license]](LICENSE.md)

Monarch is a laravel proof of concept package to run migrations from modular or nested application structures using datafiles or the default laravel configuration system.

This package is designed as an example, as there is no way to predetermine your application architecture.  It will be best utilized by forking, downloading and customizing for your application needs.

## Requirements
PHP:  This package requires php 7.0 or greater 
Laravel:  Developed with laravel 5.5 LTS

## Install

Via Composer

``` 
At composer.json of your Laravel installation, add the following:
{
    "require": {
        "cambricorp/monarch": "5.5.*"
    },
    "repositories": {
        "cambricorp/monarch": {
            "type":"vcs",
            "url": "https://github.com/cambricorp/monarch.git"
        }
    },
}
```

## Usage

### Publish package configuration
```
php artisan vendor:publish
choose monarch-config
```
The monarch.php configuration sets the datafile directory path, from the base directory of your laravel install

### Begin working with the monarch:example command

Use the example command to start experimenting with the package
```
php artisan monarch:example
```
Running the monarch:example artisan command will attempt to migrate the default user table migration.  It can be called like any other artisan command, from route, controller or another command.

### Customize for your purposes:

Add your own modular directories and datafiles:
```  
    datafile/module-migrations.php
    datafile/plugin-migrations.php - intentionally left empty
```

Merge your files:  
To run migrations from specific locations, in ExampleCommand:
```
    '--path' => array_merge(
                      $this->finder->getMigrations('module'), 
                      $this->finder->getMigrations('plugin'),
                    )
```

To run all migrations from any predetermined location, in ExampleCommand:
```
    '--path' => $this->finder->compiledMigrations()
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email cambricorp@gmail.com instead of using the issue tracker.

## Credits

- [Carl Price][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[link-author]: https://github.com/cambricorp
