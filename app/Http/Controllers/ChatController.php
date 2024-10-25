<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|string',
        ]);

        $message = $request->input('message');
        $userId = $request->input('user_id');

        $response = Http::post('http://localhost:5005/webhooks/rest/webhook', [
            'sender' => $userId,
            'message' => $message,
        ]);

        return response()->json($response->json());
    }
}
