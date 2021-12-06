<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json([
            'data' => $request->user()
        ]);
    }
}
