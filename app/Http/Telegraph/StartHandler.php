<?php

namespace App\Http\Telegraph;

use App\Models\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Stringable;

class StartHandler extends WebhookHandler
{
    public function start(): void
    {
        $this->chat->message("Salom, " . $this->message->from()->firstName() . " 👋" . PHP_EOL . "⬇️ Kontaktingizni yuboring (tugmani bosib)")
            ->replyKeyboard(ReplyKeyboard::make()->oneTime()->buttons([
                ReplyButton::make("☎️ Kontaktni Yuborish")->requestContact(),
            ]))
            ->send();
    }

    protected function handleChatMessage(Stringable $text): void
    {
        if ($this->message->contact()?->phoneNumber()) {
            $user = User::query()->where("phone", $this->message->contact()->phoneNumber())->first();

            if (!$user) {
                $user = User::query()->create([
                    "name" => $this->message->contact()->firstName() . " " . $this->message->contact()->lastName(),
                    "phone" => $this->message->contact()->phoneNumber(),
                ]);
            }

            $user->update([
                'telegraph_chat_id' => $this->chat->id,
            ]);

            $this->chat->message('Rahmat!')->removeReplyKeyboard()->send();
        }
    }
}
