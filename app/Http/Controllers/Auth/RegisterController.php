<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email' , 'unique:users'],
            'password' => ['required', 'min:5', 'confirmed'],
        ]);

        if ($validation->fails()) return response()->json(['error' => $validation->errors()], 422);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'Registration successful.'
        ]);
    }
}
