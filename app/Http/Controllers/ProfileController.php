<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ProfileController extends Controller
{
    public function index($name){
        $searchName = str_replace("-", " ", $name);

        $profile = Profile::where('name', $searchName)->first();

        if(!$profile){
            return redirect()->route('home')->withErrors(['name' => 'Name not found']);
        }

         return view('pages.profile', compact('profile'));
    }

    public function edit($name){
        $editUsername = str_replace("-", " ", $name);
        $profile = Auth::user()->profile;

        if($editUsername !== $profile->name){
            return back()->withErrors(['note' => 'You are not allowed to edit other profile']);
        }
        return view('pages.editProfile', compact('profile'));
    }

    public function editProfile($name, Request $request){
        $editUsername = str_replace("-", " ", $name);
        $profile = Auth::user()->profile;

        if($editUsername !== $profile->name){
            return back()->withErrors(['note' => 'You are not allowed to edit other profile']);
        }

        $profile->update([
            'name'=>$request->name,
            'title'=>$request->title,
            'bio'=>$request->bio,
        ]);

        return redirect()->route('profile', $name)->with('success', 'Your profile successfully updated');

    }
}
