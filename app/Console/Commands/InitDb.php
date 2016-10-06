<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class InitDb extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'init-db';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Migrate and Seed database';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->call('migrate');
		$this->call('db:seed');
        $this->info('Database created successfully!');
	}

}
