<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    public function store(Request $request, $chatId)
{
    $message = Message::create([
        'chat_id' => $chatId,
        'user_id' => $request->user()->id,
        'message' => $request->message,
    ]);

    // Broadcast event (optional)
    //broadcast(new MessageSent($message))->toOthers();

    return response()->json($message, 201);
}

public function index(Request $request, $chatId)
{
    $messages = Message::where('chat_id', $chatId)->get();
    return response()->json($messages);
}
}
