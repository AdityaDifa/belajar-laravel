<?php

namespace App\Http\Controllers;

use App\Models\Moment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MomentController extends Controller
{
    public function index()
    {
        return view('pages.createNote');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'streamer_name' => 'required|string|max:255',
            'stream_url' => 'required|string',
            'description' => 'required|string',
        ]);

        $createNote = Moment::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'streamer_name' => $request->streamer_name,
            'stream_url' => $request->stream_url,
            'description' => $request->description,
        ]);

        return redirect()->route('createNote.create')->with('success', 'Note berhasil ditambahkan!');
    }

}
