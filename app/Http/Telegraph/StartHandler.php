<?php

namespace App\Http\Telegraph;

use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class StartHandler extends WebhookHandler
{
    public function start(): void
    {
//        $this->chat->message('Salom, Telefon raqamingizni jo\'nating!')->replyKeyboard(ReplyKeyboard::make()->oneTime()->buttons([
//            ReplyButton::make("Telefon raqamni jo'natish")->requestContact(),
//        ]))->send();

        $this->chat->message($this->chat->id)->send();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        $phone = $this->message->contact()?->phoneNumber();
        $userId = $this->message->contact()?->userId();
        $verifyUserId = $this->message->from()?->id();

        $isVerifyPhone = intval($userId == $verifyUserId);

        if (!$phone) {
            $this->chat->message('telefon raqamni tashla');
        }

        $this->chat->html("Received: $phone, $userId, $verifyUserId, Total: $isVerifyPhone")->send();
    }
}
