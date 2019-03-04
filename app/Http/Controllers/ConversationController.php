<?php

namespace App\Http\Controllers;

use App\Conversations\DefaultConversation;

class ConversationController extends Controller
{
    public function index($bot)
    {
        $bot->startConversation(new DefaultConversation());
    }
}
