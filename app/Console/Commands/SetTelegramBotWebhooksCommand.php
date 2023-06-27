<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class SetTelegramBotWebhooksCommand extends Command
{
    protected $signature = 'botman:set-webhooks';

    protected $description = 'Command description';

    public function handle(): int
    {
        $res = Telegram::bot('agronomist')->setWebhook(['url' => config('telegram.bots.agronomist.webhook_url')]);

        return Command::SUCCESS;
    }
}
