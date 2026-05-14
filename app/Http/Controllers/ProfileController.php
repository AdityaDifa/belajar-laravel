<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\Moment;
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

        $countNotes = Moment::where('user_id', $profile->user_id)->count();

         return view('pages.profile', compact('profile','countNotes'));
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

        $request->validate([
            'name' => 'required|string|max:255|unique:profiles,name',
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:2000',
        ]);

        $profile->update([
            'name'=>$request->name,
            'title'=>$request->title,
            'bio'=>$request->bio,
        ]);

        return redirect()->route('profile', str_replace(" ","-",$profile->name))->with('success', 'Your profile successfully updated');

    }

    public function notes($name, Request $request){
        
        $editUsername = str_replace("-", " ", $name);
        $profile = Profile::where('name', $editUsername)->first();
        
        if(!$profile){
            return redirect()->route('home')->withErrors(['name' => 'Name not found']);
            }
            
        $keyword = $request->input('search');

        $query = Moment::with(['user'])->where('user_id', $profile->user_id);

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('streamer_name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhereHas('user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            });
        }
        $notes = $query->latest()->paginate(10)->withQueryString();

        return view('pages.notesProfile', compact('notes', 'name'));
    }
}
