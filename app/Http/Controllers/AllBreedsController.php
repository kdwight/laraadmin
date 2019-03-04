<?php

namespace App\Http\Controllers;

use App\Services\DogService;

class AllBreedsController extends Controller
{
    public function __construct()
    {
        $this->photos = new DogService();
    }

    public function random($bot)
    {
        $bot->reply($this->photos->random());
    }

    public function breed($bot, $name)
    {
        $bot->reply($this->photos->breed($name));
    }
}
