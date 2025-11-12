<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $receiverId = $request->query('receiver_id');

        $messages = Message::with(['sender', 'receiver'])
            ->where(function ($q) use ($request, $receiverId) {
                $q->where('sender_id', $request->user()->id)
                    ->where('receiver_id', $receiverId);
            })
            ->orWhere(function ($q) use ($request, $receiverId) {
                $q->where('sender_id', $receiverId)
                    ->where('receiver_id', $request->user()->id);
            })
            ->orderBy('created_at')
            ->get();

        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|min:1',
        ]);

        $message = Message::create([
            'sender_id' => $request->user()->id,
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
        ]);

        // broadcast ile gönder (artık 'user' değil, 'sender'/'receiver' yüklüyoruz)
        broadcast(new MessageSent($message->load(['sender', 'receiver'])))->toOthers();

        return response()->json($message);
    }
}
