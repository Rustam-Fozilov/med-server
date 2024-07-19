<?php

namespace App\Http\Telegraph;

use App\Http\Enums\StatusType;
use App\Models\Application;
use App\Models\User;
use Carbon\Carbon;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
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

            $this->chat->message('Rahmat! xabarnomalarni shu yerda kuting')->removeReplyKeyboard()->send();
        }
    }

    public function confirmApplication($id): void
    {
        $application = Application::query()->find($id);

        if (!is_null($application)) {
            $application->update([
                'status' => StatusType::APPROVED
            ]);
            $this->chat->message('Murojaat tasdiqlandi ✅')->send();

            $chatId = $application->user->telegraph_chat_id;

            if ($chatId) {
                $message = "Assalomu alaykum, " . $application->user->name . PHP_EOL;

                $message .= "Murojaatingiz tasdiqlandi ✅." . PHP_EOL . PHP_EOL .
                    "Kun: " . Carbon::parse($application->user->created_at)->format('d-m-Y') . PHP_EOL .
                    "Soat: " . $application->time . PHP_EOL .
                    "Shifokor: " . $application->doctor->user->name;

                TelegraphChat::query()->find($chatId)->html($message)->send();
            }
        }
    }

    public function rejectApplication($id): void
    {
        $application = Application::query()->find($id);

        if (!is_null($application)) {
            $application->update([
                'status' => StatusType::REJECTED
            ]);
            $this->chat->message('Murojaat rad etildi ❌')->send();

            $chatId = $application->user->telegraph_chat_id;

            if ($chatId) {
                $message = "Assalomu alaykum, " . $application->user->name . PHP_EOL;

                $message .= "Murojaatingiz rad etildi ❌." . PHP_EOL . PHP_EOL .
                    "Kun: " . Carbon::parse($application->user->created_at)->format('d-m-Y') . PHP_EOL .
                    "Soat: " . $application->time . PHP_EOL .
                    "Shifokor: " . $application->doctor->user->name;

                TelegraphChat::query()->find($chatId)->html($message)->send();
            }
        }
    }
}
