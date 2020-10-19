<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User as User;

class AuthController extends Controller
{
    public function Login(Request $request)
    {
        return View::make('system\dashboard');
    }

    public function Do_Login(Request $request)
    {
        if (isset($request->username) && isset($request->password)) {
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                // Success Login สำเร็จ
                return response()->json(['massage' => 'เข้าสู่ระบบสำเร็จ กรุณารอซักครู่'],200);
            }else{
                // Error Login ไม่สำเร็จ
                return response()->json(['massage' => 'ชื่อผู้ใช้งาน และ รหัสผ่าน ไม่ถูกต้อง'],400);
            }
        } else {
            return response()->json(['massage' => 'Parameter ไม่ครบ'],400);
        }
    }

    public function Do_Register(Request $request)
    {
        if (isset($request->username) && isset($request->password) && isset($request->name)) {
            $insert_user = new User;
            $insert_user->name = $request->name;
            $insert_user->username = $request->username;
            $insert_user->password = Hash::make($request->password);
            $insert_user->save();     
            return response()->json(['massage' => 'สมัครสมาชิก สำเร็จ'],200);
        } else {
            return response()->json(['massage' => 'Parameter ไม่ครบ'],400);
        }
    }

    public function Do_Logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
