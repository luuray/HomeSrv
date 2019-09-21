<?php

namespace App\Console\Commands\Swoole;

use App\Model\Sensor;
use App\Model\SensorRecord;
use Bschmitt\Amqp\Consumer;
use Bschmitt\Amqp\Message;
use Illuminate\Console\Command;
use phpDocumentor\Reflection\Types\Null_;
use Swoole\Client;
use Swoole\Server;
use Symfony\Component\Console\Input\InputArgument;

class AmqpConsumer extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'swoole:amqp_consumer
    {action : Consumer control action: start, stop, status}
    {--worker-num=1 : Consumer worker num}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Amqp Consumer in Swoole';

	protected $server_socket;
	protected $queues;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->server_socket = storage_path('amqp_consumer.sock');
		$this->queues        = explode(',', env('RABBITMQ_QUEUES', ''));
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		switch ($this->argument('action')) {
			case 'start':
				$this->worker_start();
				break;
			case 'stop':
				$this->worker_stop();
				break;
			case 'status':
				$this->worker_status();
				break;
			default:
				$this->warn('invalid control action, allowed: start, stop, status');
		}
	}

	public function getArguments()
	{
		return [
			[
				'action', InputArgument::REQUIRED, 'missing control action, allowed: start, stop, status'
			]
		];
	}

	protected function worker_start()
	{
		if (file_exists($this->server_socket)) {
			$this->error('worker_started');

			return 0;
		}

		if (empty($this->queues)) {
			$this->warn('consume_queue_undefined: .env=>RABBITMQ_QUEUES');
		}

		$workerServer = new Server($this->server_socket, 0, SWOOLE_PROCESS, SWOOLE_UNIX_STREAM);
		$workerServer->set([
			'log_file'         => storage_path('logs/amqp_consumer.log'),
			'worker_num'       => count($this->queues) + 1,
			'task_worker_num'  => $this->option('worker_num'),
			'task_max_request' => 1024
		]);

		$workerServer->on('workerStart', function (Server $server, $workerId) {
			if ($workerId !== 0) {
				$queue_name = $this->queues[$workerId - 1];
				\Amqp::consume($queue_name, function (Message $message, Consumer $resolver) use ($server, $workerId) {
					$server->task([$message, $resolver], $workerId, function () use ($message) {
						$this->info('job_finish:' . $message->getBody());
					});
				});
			}
		});

		$workerServer->on('connect', function (Server $server, $fd, $reactorId) {
		});

		$workerServer->on('receive', function (Server $server, $fd, $reactorId, $data) {
		});

		$workerServer->on('close', function (Server $server, $fd, $reactorId) {
		});

		$workerServer->on('workerError', function (Server $server, $workerId, $workerPid, $exitCode, $signal) {

		});

		$workerServer->on('task', function (Server $server, $taskId, $srcWorkerId, $data) {
			[$message, $resolver] = $data;
			$sensorRecord = new SensorRecord();

		});
		$workerServer->on('finish', function (Server $server, $taskId, $data) {
		});
	}

	protected function worker_stop()
	{
		if (!file_exists($this->server_socket)) {
			$this->warn('worker_not_start');

			return 0;
		}

		$ctrlClient = new Client(SWOOLE_UNIX_STREAM);
		$ctrlClient->connect($this->server_socket);

	}

	protected function worker_status()
	{
		if (!file_exists($this->server_socket)) {
			$this->warn('worker_not_start');

			return 0;
		}
		$ctrlClient = new Client(SWOOLE_UNIX_STREAM);
		$ctrlClient->connect($this->server_socket);

	}
}
