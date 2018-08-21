<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

// $botman->hears('Hi', function ($bot) {
//     $bot->reply('Hello!');
// });
// $botman->hears('Hola', function ($bot) {
//     $bot->reply('Bienvenido a Subway!');
//     $bot->reply('En que te podemos servir.');
// });
$botman->hears('Hola', BotManController::class.'@startConversation');
