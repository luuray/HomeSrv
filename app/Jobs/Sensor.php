<?php

namespace App\Jobs;

use App\Services\SensorService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpAmqpLib\Message\AMQPMessage;

class Sensor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AMQPMessage $message)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SensorService $service)
    {
    }

    public function fail($exception = null)
    {
    	Log::info(json_encode(var_export($this,true)));
    }
}
