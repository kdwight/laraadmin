<?php

namespace App\Http\Controllers;

class FallbackController extends Controller
{
    public function index($bot)
    {
        $bot->reply("sorry, i don't understand bonaks. Try: \'arf arf\' ");
    }
}
