<?php

namespace Pluma\Console;

class Kernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    public $commands = [
        \Pluma\Console\Commands\ModelGeneratorCommand::class,
        \Pluma\Console\Commands\ControllerGeneratorCommand::class,
        \Pluma\Console\Commands\MigrationGeneratorCommand::class,
        \Pluma\Console\Commands\ViewGeneratorCommand::class,
        \Pluma\Console\Commands\MigrateCommand::class,
        \Pluma\Console\Commands\ModuleGeneratorCommand::class,
        \Pluma\Console\Commands\SeedDatabaseCommand::class,
        \Pluma\Console\Commands\SeederGeneratorCommand::class,
    ];
}
