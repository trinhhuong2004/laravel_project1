<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Đăng nhap
        public function showFormLogin()
        {
            return view('auth.login');
        }
        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('admins.dashboard')->with('success', 'Đăng nhập thành công');
            }
            return back()->withErrors([
                'email' => 'Email hoặc pass không đúng.',
            ])->onlyInput('email');
        }
    // Đăng ký

        public function showFormRegister()
        {
            return view('auth.register');

        }
        public function register(Request $request)
        {
            // dd($request->all());
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|max:255',
            ], [
                'email.unique' => 'Email này đã tồn tại trên hệ thống.',
            ]);

            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $data['password'] = bcrypt($data['password']);

            $user = User::query()->create($data);
            Auth::login($user);
            return redirect()->route('admins.dashboard')->with('success', 'Đăng ký thành công');
        }
    // Đăng xuât
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
