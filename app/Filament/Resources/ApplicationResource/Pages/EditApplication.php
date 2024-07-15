<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Http\Enums\StatusType;
use Carbon\Carbon;
use DefStudio\Telegraph\Models\TelegraphChat;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditApplication extends EditRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $status = $data['status'];

        if ($status !== StatusType::APPROVED->value && $status !== StatusType::REJECTED->value) {
            $record->update($data);
            return $record;
        }

        $application = $record->newQuery()->findOrFail($data['id']);
        $chatId = $application->user->telegraph_chat_id;

        if ($chatId) {
            $chat = TelegraphChat::query()->find($chatId);
            $message = "Assalomu alaykum, " . $application->user->name . PHP_EOL;

            if ($status === StatusType::APPROVED->value) {
                $message .= "Murojaatingiz tasdiqlandi ✅." . PHP_EOL;
            } else if ($status === StatusType::REJECTED->value) {
                $message .= "Murojaatingiz rad etildi ❌." . PHP_EOL;
            }

            $message .= PHP_EOL .
                "Kun: " . Carbon::parse($application->user->created_at)->format('d-m-Y') . PHP_EOL .
                "Soat: " . $application->time . PHP_EOL .
                "Shifokor: " . $application->doctor->user->name;

            $chat->html($message)->send();
        }


        $record->update($data);
        return $record;
    }
}
