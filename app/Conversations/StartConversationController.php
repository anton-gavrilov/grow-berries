<?php

namespace App\Conversations;

use App\Models\User;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Hash;
use Mockery\Exception;
use Str;

class StartConversationController extends Conversation
{
    /**
     * @var User
     */
    public $user = null;
    /**
     * @var \BotMan\BotMan\Users\User
     */
    public $telegramUser = null;

    public function run()
    {
        try {
            $this->telegramUser = $this->bot->getUser();

            if (!($this->user = User::where('telegram_id', $this->telegramUser->getId())->first())) {
                $this->bot->reply(__('telegram.user_not_found'));
                $this->askEmail(__('telegram_start.enter_email_to_register_user'));
            } else {
                $this->say(__('telegram_start.welcome', ['user' => $this->user->name]));
            }
        } catch (Exception $e) {
            $this->bot->reply($e->getMessage());
        }
    }

    public function askCode()
    {
        try {
            $this->user->sendEmailVerificationCodeNotification();

            $this->ask(__('telegram_start.verify_email_question', ['email' => $this->user->email]), function (Answer $answer) {
                $code = $answer->getText();

                if (!($this->user = User::where('telegram_id', $this->telegramUser->getId())->first())) {

                    return;
                }

                if ($this->user->email_verification_code != $code) {
                    $this->say(__('telegram_start.verify_email_code_wrong'));
                    $this->askCode();
                    return;
                }
                $this->user->markEmailAsVerified();
                $this->say(__('telegram_start.verify_email_code_confirmed'));
            });
        } catch (Exception $e) {
            $a = 1;
        }
    }

    public function askEmail($question)
    {
        try {
            $this->ask($question, function (Answer $answer) {
                $email = $answer->getText();

                $validator = \Validator::make(['email' => $email], ['email' => ['email', 'unique:users']]);
                if ($validator->fails()) {
                    $this->say(__($validator->errors()->first()));
                    return $this->repeat(__('telegram_start.enter_email_to_register_user'));
                }

                try {
                    $this->user = User::forceCreate([
                        'name' => $this->telegramUser->getFirstName() . ' ' . $this->telegramUser->getLastName(),
                        'email' => $email,
                        'telegram_id' => $this->telegramUser->getId(),
                        'password' => Hash::make($password = Str::random(8)),
                        'email_verification_code' => Str::random(6),
                    ]);

                    try {
                        $this->user->save();
                    } catch (\Exception $e) {
                        $this->bot->reply('not saved');
                    }

                    return $this->askCode();
                } catch (\Exception $e) {
                    $a = 1;
                    return;
                }
                $this->say(__('telegram_start.registered'));
            });
        } catch (Exception $e) {
            $a = 1;
        }
    }
}
