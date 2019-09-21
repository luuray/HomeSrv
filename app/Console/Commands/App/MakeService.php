<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeService extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:service
    {name : Service name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make app service';

	protected function getStub()
	{
		return resource_path('stub/common/service.stub');
	}

	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Services';
	}

	protected function getPath($name)
	{
		$name = Str::replaceFirst($this->rootNamespace(), '', $name);

		return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
	}

	protected function replaceClass($stub, $name)
	{
		$class = str_replace($this->getNamespace($name) . '\\', '', $name);

		return str_replace(
			['DummyClass'],
			[$class,],
			$stub);
	}

	protected function getArguments()
	{
		return [
			[
				'name', InputArgument::REQUIRED, 'Service Name',
			]
		];
	}
}
