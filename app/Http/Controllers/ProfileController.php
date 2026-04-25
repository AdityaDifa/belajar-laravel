<?php

namespace App\Http\Controllers;
use App\Models\Profile;

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
}
