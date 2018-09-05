<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;
use Pluma\Helpers\Config;

class ModuleGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluma:module
        {name : The name of the Module}
        {--p|plain : Only creates the Models, Controllers, and views folder}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Filesystem $file)
    {
        $name = $this->argument('name');
        $options = $this->option();

        $directories = ['Models', 'Controllers', 'views', 'config', 'database/migrations'];
        $filenames = ['config/menu.php'];
        foreach ( $directories as $directory ) {
            $file->directory( base_path("modules/$name/$directory"), false );
        }

        foreach ( $filenames as $filename ) {
            $file->make( base_path("modules/$name/$filename"), "" );
        }

        if ( ! $options['plain'] ) {
            $this->call("pluma:model", ['name' => $name, '--module' => $name]);
            $this->call("pluma:controller", ['name' => "{$name}Controller", '--module' => $name, '--resource' => 1]);
            $this->call("pluma:view", ['--module' => $name]);

            $migration_name = "create_" . strtolower( str_plural( $name ) ) . "_table";
            $this->call("pluma:migration", ['name' => $migration_name, '--module' => $name, '--create' => strtolower(str_plural($name))]);
        }

        $this->info("Created module $name");
    }
}
