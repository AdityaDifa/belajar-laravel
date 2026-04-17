<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moment;

class DashboardController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('search');

        $query = Moment::with(['user']);

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('streamer_name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhereHas('user.profile', function ($q) use ($keyword) {
                        $q->where('nama', 'like', "%{$keyword}%");
                    });
            });
        }

        $totalNotes = $query->count();

        $notes = $query->latest()->paginate(10)->withQueryString();

        return view('pages.dashboard', compact('notes', 'totalNotes'));
    }
}
