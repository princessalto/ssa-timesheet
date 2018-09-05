<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;

class ViewGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluma:view
        {--m|module=Pluma : The module to put the view files into}
        {--f|folder= : Put the files inside a folder}
        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

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
        extract( $this->option() );

        if ( "Pluma" == $module && ! $this->confirm("Module will default to $module. Proceed?", ['yes', 'no'], true) ) {
            $module = $this->anticipate( "Please specify the module of this model", config("modules.enabled") );
        }

        $folder = $folder ? "$folder/" : "";
        foreach ( ['create', 'edit', 'index', 'show'] as $view ) {
            $file->make(
                base_path("modules/$module/views/{$folder}{$view}.blade.php"),
                "",
                false,
                true // quiet
            );
        }


        $this->info("View files created for module $module");
    }
}
