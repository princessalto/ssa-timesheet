<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;

class SeederGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluma:seeder
        {name : The name of the seeder class}
        {--m|module=Pluma : The module to put the view files into}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class';

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
        $name = $this->argument("name");
        $options = $this->option();
        $module = $options['module'];

        if ( "Pluma" == $module && ! $this->confirm("Module will default to $module. Proceed?", ['yes', 'no'], true) ) {
            $module = $this->anticipate( "Please specify the module of this model", config("modules.enabled") );
        }

        $file->make(
            base_path("modules/$module/database/seeds/{$name}.php"),
            $file->put( base_path("modules/Pluma/Console/Templates/stubs/TableSeeder.txt"), compact(['module', 'name']) ),
            false,
            true // quiet
        );

        $this->info("Seeder Class created for module $module in /modules/$module/database/seeds/{$name}.php");
    }
}
