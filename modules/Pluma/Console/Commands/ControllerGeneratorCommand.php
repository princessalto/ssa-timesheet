<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;

class ControllerGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluma:controller
        {name : The name of the controller class}
        {--m|module=Pluma : The module to put the controller class into}
        {--f|force : Force overwrite if file already exists}
        {--a|admin : If the controller should extend the Pluma\Controller\AdminController::class}
        {--r|resource : Generate a resource controller class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller class';

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
        $controller = $this->argument('name');
        $module = $this->option('module');

        if ( "Pluma" == $module && ! $this->confirm("Module will default to $module. Proceed?", ['yes', 'no'], true) ) {
            $module = $this->anticipate( "Please specify the module of this model", config("modules.enabled") );
        }

        $filename = $this->option('admin') ? base_path("modules/Pluma/Console/Templates/stubs/ControllerAdmin.txt") : base_path("modules/Pluma/Console/Templates/stubs/Controller.txt");

        $resource = $this->option('resource') ? $file->put(base_path("modules/Pluma/Console/Templates/stubs/ControllerResource.txt"), []) : "//";

        $file->make(
            base_path("modules/$module/Controllers/$controller.php"),
            $file->put( $filename, compact(['module', 'controller', 'resource']) ),
            $this->option('force')
        );
        $this->info("Created controller $controller for module $module");
    }
}
