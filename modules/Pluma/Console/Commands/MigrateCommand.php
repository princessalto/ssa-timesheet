<?php

namespace Pluma\Console\Commands;

use Pluma\Filesystem\Filesystem;
use Illuminate\Console\Command;

class MigrateCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'pluma:migrate
		{--m|module=Pluma : The module to put the view files into}
		{--a|all : Put the files inside a folder}
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

		$modules = config("modules.enabled");


		foreach ( $modules as $module ) {
			$this->call("migrate", [
				'--path' => "modules/$module/database/migrations",
			]);
		}
	}
}
