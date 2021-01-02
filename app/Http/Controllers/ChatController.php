<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PhpJunior\LaravelVideoChat\Facades\Chat;
use PhpJunior\LaravelVideoChat\Models\Conversation\Conversation;

class ChatController extends Controller
{

    public function list()
    {
        $groups = Chat::getAllGroupConversations();
        $conversations = Chat::getAllConversations();

        Cookie::queue('lastChatTime', Carbon::now(), 525600);
        return view(
            'chat.list',
            compact('groups', 'conversations')
        );
    }

    public function view($id)
    {
        $conversation = Chat::getConversationMessageById($id);

        return view('chat.view', compact('conversation'));
    }

    public function start($userId)
    {
        Chat::startConversationWith($userId);
        $conversations = Conversation::where(
            'first_user_id',
            auth()->id()
        )->get();
        $conversation = $conversations->last();
        Chat::sendConversationMessage(
            $conversation->id,
            'First message dari patient ke terapis'
        );

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
        Chat::startVideoCall($id, $request->all());
    }
}
