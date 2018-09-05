<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;

class ModelGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluma:model
        {name : The name of the model class}
        {--m|module=Pluma : The module to put the model class into}
        {--f|force : Force overwrite if file already exists}
        {--y|yes : Uses the default module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

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
        $model = $this->argument('name');
        $module = $this->option('module');
        $no = ! $this->option('yes');

        if ( $no && "Pluma" == $module && ! $this->confirm("Module will default to $module. Proceed?", ['yes', 'no'], true) ) {
            // config("modules.enabled")
            $module = $this->anticipate( 'Please specify the module of this model', config("modules.enabled") );
            // dd($module);
        }

        $file->make(
            base_path("modules/$module/Models/$model.php"),
            $file->put( base_path("modules/Pluma/Console/Templates/stubs/Model.txt"), compact(['module', 'model']) ),
            $this->option('force')
        );
        $this->info("Created model $model for module $module");
    }
}
