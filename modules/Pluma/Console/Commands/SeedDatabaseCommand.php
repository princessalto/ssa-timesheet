<?php

namespace Pluma\Console\Commands;

use Illuminate\Console\Command;

class SeedDatabaseCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'pluma:seed
		{--a|all : Seeds from all modules}
		';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Seed database with records';

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
	public function handle()
	{
		$all = $this->option('all');
		$modules = config("modules.enabled");

		foreach ( $modules as $module ) {
			if ( file_exists("modules/$module/database/seeds/DatabaseSeeder.php") ) {
				$this->call("db:seed", [
					"--class" => "$module\Database\Seeds\DatabaseSeeder",
				]);
			}
		}
	}
}
