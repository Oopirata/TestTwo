<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->withinput()->with(['error' => 'Invalid login credentials']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    protected function username()
    {
        return 'username';
    }
}
