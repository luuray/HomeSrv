<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Requests\TelegramWebhookRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    //
	public function ping(TelegramWebhookRequest $request)
	{
		Log::info(json_encode(['request'=>$request, 'raw'=>$request->getContent()]));
		return response()->json($request);
	}
}
