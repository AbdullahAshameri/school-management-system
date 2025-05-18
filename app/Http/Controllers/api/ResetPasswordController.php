<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function checkPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $phone = $request->phone;

        $user = User::where('userPhone', $phone)->first();

        if ($user) {
            $user->resetpassword = 2;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset flag updated.',
            ], 200);
        } else {
            return response()->json([
                'status' => 'failure',
                'message' => 'Phone is not found.',
            ], 200); // حسب طلبك الحالة تبقى 200 حتى لو فشل
        }
    }
}
