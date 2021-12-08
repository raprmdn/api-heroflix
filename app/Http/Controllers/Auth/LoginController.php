<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $validation = \Validator::make($request->all() ,[
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['required'],
        ]);

        if ($validation->fails()) return response()->json(['errors' => $validation->errors()], 422);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => [
                    'email' => ['The provided credentials are incorrect.'],
                ],
            ]);
        }

        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' => $user,
            'message' => "You've been logged in.",
            'status' => true
        ]);
    }
}
