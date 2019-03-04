<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('.*Hi.*', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class . '@startConversation');
$botman->hears('call me {name} the {adjective}', function ($bot, $name, $adjective) {
    $bot->reply('Hello ' . $name . '.  You truly are ' . $adjective);
});

$botman->hears('.*bonak.*', function ($bot) {
    $bot->reply('lolo mo!');
});
$botman->hears('flirt', function ($bot) {
    $bot->reply('Years ago, when I was backpacking across Western Europe, I was just outside of Barcelona, hiking in the foothills of mount Tibidabo.
I was at the end of this path, and I came to a clearing, and there was a lake, very secluded, and there were tall trees all around.
It was dead silent. Gorgeous. And across the lake I saw a beautiful woman bathing herself. But she was crying... ');
});
$botman->hears('blue french horn or yellow umbrella', function ($bot) {
    $bot->reply('cheddar');
});
$botman->hears('spotify playlist', function ($bot) {
    $bot->reply('https://open.spotify.com/user/spotify/playlist/37i9dQZF1DWZ85m0oUYmSB?si=57hW4_2GSsKd3FwoWQOAgQ');
});

$botman->hears('/random', 'App\Http\Controllers\AllBreedsController@random');
$botman->hears('/b {breed}', 'App\Http\Controllers\AllBreedsController@breed');
$botman->hears('/s {breed}:{subBreed}', 'App\Http\Controllers\SubBreedController@random');
$botman->hears('arf arf', 'App\Http\Controllers\ConversationController@index');
$botman->fallback('App\Http\Controllers\FallbackController@index');
