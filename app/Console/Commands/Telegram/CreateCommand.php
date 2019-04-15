<?php

namespace App\Console\Commands\Telegram;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateCommand extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'telegram:create_command 
    {name : The command}
    {desc : Command description}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create telegram command set';

	protected function getStub()
	{
		return resource_path('stub/telegram/Command.php');
	}

	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Telegram\Commands';
	}

	protected function getPath($name)
	{
		$name = Str::replaceFirst($this->rootNamespace(), '', $name);

		return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Command.php';
	}

	protected function replaceClass($stub, $name)
	{
		$class = str_replace($this->getNamespace($name) . '\\', '', $name);

		return str_replace(
			['DummyClass', 'dummy:command', 'dummy:description'],
			[
				$class,
				Str::snake($this->argument('name')),
				$this->argument('desc')
			],
			$stub);
	}

	protected function getArguments()
	{
		return [
			[
				'name', InputArgument::REQUIRED, 'The name of the command',
				'desc', InputArgument::OPTIONAL, 'Command description'
			],
		];
	}
}
