<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpJunior\LaravelVideoChat\Facades\Chat;
use PhpJunior\LaravelVideoChat\Models\Conversation\Conversation;

class ChatController extends Controller
{
    public function list()
    {
        $groups = Chat::getAllGroupConversations();
        $conversations = Chat::getAllConversations();

        // dd($conversations[0]->message->conversation->second_user_id);
        return view('chat.list', compact('groups', 'conversations'));
    }

    public function view($id)
    {
        $conversation = Chat::getConversationMessageById($id);

        return view('chat.view', compact('conversation'));
    }

    public function start($userId)
    {
        Chat::startConversationWith($userId);
        $conversations = Conversation::where('first_user_id', auth()->id())
            ->get();
        $conversation = $conversations->last();
        Chat::sendConversationMessage($conversation->id, 'First message dari patient ke terapis');

        return redirect()->route('chat.list');
    }

    public function sendMessage(Request $request)
    {
        Chat::sendConversationMessage($request->conversationId, $request->text);
    }

    public function accept($conversationId)
    {
        Chat::acceptMessageRequest($conversationId);

        return redirect()->route('chat.list');
    }

    public function startCall($id, Request $request)
    {
        Chat::startVideoCall($id , $request->all());
    }
}
