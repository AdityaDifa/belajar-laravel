<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('pages.register');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:profiles,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'title' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->profile()->create([
            'name' => $request->name,
            'title' => $request->title // Kita masukkan 'title' ke kolom bio/sebutan tadi
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
