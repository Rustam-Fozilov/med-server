<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(ApplicationRequest $request)
    {
        $user = User::query()->where('phone', '=', $request['phone'])->first();

        if (is_null($user)) {
            $user2 = User::query()->create([
                'name' => $request['f_name'] . ' ' . $request['l_name'],
                'phone' => $request['phone'],
            ]);
        }

        return response()->json($user2);
    }
}
