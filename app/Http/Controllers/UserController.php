<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $data = $request->all();
        $user = User::where('login', $data['login'])->first();
        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                $user->token = Str::random(60);
                $user->save();

                return [
                    'token' => $user->token
                ];
            }
        }

        return response('Authentication failed', 401);
    }

    public function logout(Request $request)
    {
        $user = User::where('token', $request->bearerToken())->first();
        if ($user) {
            $user->token = null;
            $user->save();
        }

        return response('ok', 200);
    }
}
