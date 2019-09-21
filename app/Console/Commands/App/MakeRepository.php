<?php

namespace App\Console\Commands\App;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepository extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:repository
    {name : repository name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Make app repository';

	protected function getStub()
	{
		return resource_path('stub/common/repository.stub');
	}

	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Repositories';
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
				'name', InputArgument::REQUIRED, 'Repository Name',
			]
		];
	}
}
