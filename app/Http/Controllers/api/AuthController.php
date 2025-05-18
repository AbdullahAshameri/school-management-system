<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller; //  This is the missing import
use App\Models\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required|integer'
        ]);

        if($request->role_id == 1){
                    // Try to find user by email
        $user = User::where('email', $request->email)->first();
        }elseif($request->role_id == 2){        // Try to find user by email
        $user = Teacher::where('email', $request->email)->first();
        }else{
            return response()->json([
                'status' => 'failure',
                'message' => 'Invalid email or password',
            ], 400);
        }
        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ], 200);
        }

        // Failure response
        return response()->json([
            'status' => 'failure',
            'message' => 'Invalid email or password',
        ], 200);
    }
}
