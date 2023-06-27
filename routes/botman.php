<?php

Route::post('/', \App\Http\Controllers\BotManChatController::class);

$botman = app('botman');

$botman->hears('/start',  function(\BotMan\BotMan\BotMan $bot){
    try {
        $bot->startConversation(new \App\Conversations\StartConversationController());
    } catch (Exception $e) {
        $a = 1;
    }
});
$botman->on('event', function($payload, $bot) {
    $bot->reply('Sorr');
});
$botman->exception(\Exception::class, function($exception, $bot) {
    $bot->reply('Sorry, 111something went wrong');
});
