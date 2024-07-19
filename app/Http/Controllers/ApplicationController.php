<?php

namespace App\Http\Controllers;

use App\Http\Enums\StatusType;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(StoreApplicationRequest $request): JsonResponse
    {
        $user = User::query()->where('phone', '=', $request['phone'])->first();

        if (is_null($user)) {
            $user = User::query()->create([
                'name' => $request['f_name'] . ' ' . $request['l_name'],
                'phone' => $request['phone'],
            ]);
        }

        $application = Application::query()->create([
            'user_id' => $user->id,
            'doctor_id' => $request['doctor_id'],
            'date' => $request['date'],
            'time' => $request['time'],
        ]);
        $doctor = Doctor::query()->find($request['doctor_id']);
        $chat_id = $doctor->user->telegraph_chat_id;

        if ($chat_id) {
            $chat = TelegraphChat::query()->find($chat_id);
            $chat->message(
                "Salom " . $doctor->user->name . "!" . PHP_EOL .
                "Yangi murojaat:" . PHP_EOL . PHP_EOL .
                "F.I.O: " . $request['f_name'] . " " . $request['l_name'] . PHP_EOL .
                "Telefon: " . $request['phone'] . PHP_EOL .
                "Sana: " . $request['date'] . PHP_EOL .
                "Vaqt: " . $request['time'] . PHP_EOL .
                "Yaratilgan sana: " . $application->created_at
            )
                ->keyboard(
                    Keyboard::make()->buttons([
                    Button::make('Tasdiqlash ✅')->action('confirmApplication')->param('id', $application->id),
                    Button::make('Rad etish ❌')->action('rejectApplication')->param('id', $application->id),
                ]))
                ->send();
        }

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!'
        ]);
    }
}
