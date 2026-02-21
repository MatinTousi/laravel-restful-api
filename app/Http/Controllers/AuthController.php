<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|between:5,30',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:5',
            'role' => 'required|string',
        ]);

        $role = match ($request->role) {
            'نویسنده' => 1,
            'ویرایشگر' => 2,
            default => 0,
        };

        $admin = Admin::create([
            'name' =>  $request->name,
            'email' =>  $request->email,
            'password' => Hash::make($request->password),
            'role' =>  $role
        ]);



        if (!$admin) {
            return response()->json([
                'error' => 'اکانت تشکیل نشد'
            ], 500);
        }

        return response()->json([
            'success' => 'با موفقیت تشکیل شد',
        ], 200);
    }



    public function login(Request $request)
    {
        if (is_null(auth('sanctum')->user())) {

            $request->validate([
                'email' => 'required|email|exists:admins,email',
                'password' => 'required|string|min:5',
            ]);


            $admin = Admin::where('email', $request->email)->first();



            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return response()->json([
                    'error' => 'رمز عبور یا نام کاربری اشتباه است!'
                ], 401);
            }
            $admin->tokens()->delete();
            $token = $admin->createToken('admin-token')->plainTextToken;


            return response()->json([
                'success' => 'با موفقیت وارد شدید',
                'token' => $token,
            ], 200);
        }
        return response()->json([
            'message' => 'شما یکبار لاگین کردید'
        ], 200);
    }

    public function logout()
    {


        $user = auth('sanctum')->user();
        if (is_null($user)) {
            return response()->json([
                'message' => 'شما لاگین نیستید'
            ], 401);
        }

        $admin = Admin::where('email', auth('sanctum')->user()->email)->first();

        $admin->tokens()->delete();

        return response()->json([
            'success' => 'با موفقیت خارج شدید'
        ], 200);
    }
}
