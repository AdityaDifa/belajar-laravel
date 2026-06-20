<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('pages.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        
        if (Auth::attempt($credentials)) {
            // Jika sukses, buat ulang session (keamanan dari session fixation)
            $request->session()->regenerate();
            
            $name = Auth::user()->profile->name;
            
            //jika ada titipan
            $redirect_to = $request->query('redirect');
            if (!empty($redirect_to)) {
                // Jika ada, langsung balikkan ke halaman semula tadi
                return redirect(urldecode($redirect_to));
            }else{
                // Arahkan ke halaman utama atau dashboard
                return redirect()->intended('/')->with('success', 'welcome back - '. $name);
            }

        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
