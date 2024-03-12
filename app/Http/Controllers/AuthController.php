<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginStore(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember_me ? "true" : "false";


        $user = User::query()->where('email', $email)->first();

        if (!$user){
            return redirect()->route('login')->with('error', 'Email və ya Şifrə yanlışdır!');
        }

        if (!Hash::check($password, $user->password))
        {
            return redirect()->route('login')->with('error', 'Email və ya Şifrə yanlışdır!');
        }

        Auth::login($user, $remember);
        return redirect()->route('admin.index');
    }

    public function registerStore(RegisterRequest $request)
    {
        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('login')->with(['success' => 'Qeydiyyat tamamlanmışdır']);
    }

    public function logout()
    {
        if (!Auth::check())
        {
            return back()->with('error', 'Siz artıq çıxış etmisiz!');
        }
        Auth::logout();
        return redirect()->route('login')->with('success', 'Çıxış prosesi uğurla icra edildi!');
    }
}
