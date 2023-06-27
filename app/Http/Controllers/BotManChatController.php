<?php

namespace App\Http\Controllers;


use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;

class BotManChatController extends Controller
{
    public function __invoke()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $botman = app('botman');

        $botman->exception(\Exception::class, function($exception, $bot) {
            $bot->reply('Sorry, something went wrong');
        });

        $botman->listen();
        return response('');
    }
}
