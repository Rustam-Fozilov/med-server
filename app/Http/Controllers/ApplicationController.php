<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        Application::query()->create([
            'user_id' => $user->id,
            'doctor_id' => $request['doctor_id'],
            'date' => $request['date'],
            'time' => $request['time'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully!'
        ]);
    }
}
