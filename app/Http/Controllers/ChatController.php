<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //
    public function store(Request $request)
{
    $chat = Chat::create($request->all());
    $chat->users()->attach($request->user_ids);

    return response()->json($chat, 201);
}

public function index(Request $request)
{

    $chats = $request->user()->chats;
    return response()->json($chats);
}
}
