<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateNoteController extends Controller
{
    public function index(){
        return view('pages.createNote');
    }
}
