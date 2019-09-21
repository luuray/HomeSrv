<?php

namespace App\Http\Controllers\Telegram;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PostPingController
 *
 * @package App\Http\Controllers\Telegram
 * @desc Ping for create channel post
 */
class PostPingController extends Controller
{
	public function ping($bot_name, Request $request)
	{
		if (!$request->has('token')) {
			return response()->json(['message' => 'missing_token'], 401);
		}
	}
}
