<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;

class MigrationGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluma:migration
        {name : The name of the migration}
        {--m|module=Pluma : The module to put the migrations file into}
        {--c|create= : The table to be created}
        {--t|table= : The table to migrate}
        {--p|path= : The location where the migration file should be created}
        {--f|force : Force overwrite if file already exists}
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
        $name = $this->argument('name');
        $filename = date("Y_m_d_His") . "_$name";
        extract( $this->option() );
        $output_path = base_path("modules/$module/database/migrations/$filename.php");

        if ( "Pluma" == $module && ! $this->confirm("Module will default to $module. Proceed?", ['yes', 'no'], true) ) {
            $module = $this->anticipate( "Please specify the module of this model", config("modules.enabled") );
        }

        $template = base_path("modules/Pluma/Console/Templates/stubs/Migrations.txt");
        $classname = studly_case( $this->argument('name') );

        if ( $create ) {
            $template = base_path("modules/Pluma/Console/Templates/stubs/MigrationsCreate.txt");
            $tablename = $create;
        } elseif ( $table ) {
            $template = base_path("modules/Pluma/Console/Templates/stubs/MigrationsTable.txt");
            $tablename = $table;
        }

        if ( $path ) {
            $output_path = base_path("$path/$filename.php");
        }

        $file->make(
            $output_path,
            $file->put( $template, compact(['classname', 'tablename']) ),
            $this->option('force')
        );
        $this->info("Migration created $filename for module $module");
    }
}
