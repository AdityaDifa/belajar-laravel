<?php

namespace App\Http\Controllers;

use App\Models\CommentsMoments;
use App\Models\Moment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MomentController extends Controller
{
    public function index()
    {
        return view('pages.createNote');
    }

    public function store(Request $request)
    {
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

    public function detailNote($id)
    {
        $note = Moment::with([
            'user', 
            'comments' => function($query) {
                $query->latest();
            },
            'comments.user'
        ])
        ->withExists([
            'likes' => function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->whereRaw('1 = 0');
                }
            }
        ])
        ->withExists([
            'dislikes' => function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->whereRaw('1 = 0');
                }
            }
        ])
        ->findOrFail($id);

        return view('pages.detailNote', compact('note'));
    }

    public function deleteNote($id)
    {
        $note = Moment::findOrFail($id);

        if ($note->user_id != Auth::id()) {
            // Jika bukan, kasih error 403 (Forbidden)
            abort(403, 'Waduh, kamu nggak boleh hapus catatan orang lain ya!');
        }

        $note->delete();

        return redirect()->route('home')->with('success', 'Catatan berhasil dihapus!');
    }

    public function editNote($id)
    {

        $note = Moment::findOrFail($id);

        if ($note->user_id != Auth::id()) {
            // Jika bukan, kasih error 403 (Forbidden)
            abort(403, 'Waduh, kamu nggak boleh edit catatan orang lain ya!');
        }

        return view('pages.editNote', compact('note'));
    }

    public function putNote($id, Request $request)
    {
        // 1. Cari datanya
        $note = Moment::findOrFail($id);

        // 2. Validasi kepemilikan lagi (Penting untuk keamanan!)
        if ($note->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Waduh, kamu nggak boleh hapus catatan orang lain ya!'
            ], 403);
        }

        // 3. Validasi input form
        $request->validate([
            'title' => 'required|max:255',
            'streamer_name' => 'required',
            'stream_url' => 'required|url',
            'description' => 'required',
        ]);

        // 4. Update datanya
        $note->update([
            'title' => $request->title,
            'streamer_name' => $request->streamer_name,
            'stream_url' => $request->stream_url,
            'description' => $request->description,
        ]);

        // 5. Redirect balik ke halaman detail dengan pesan sukses
        return redirect()->route('detailNote', $note->id)->with('success', 'Catatan berhasil diperbarui!');
    }

    public function deleteComment($id){
        $comment = CommentsMoments::findOrFail($id);

        if ($comment->user_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Waduh, kamu nggak boleh hapus catatan orang lain ya!'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'comment sukses dihapus'
        ], 200);
    }

    public function getComments($id){
        $moment = Moment::findOrFail($id);

        $comments = $moment->comments()->with('user')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $comments,
            'userId'=>Auth::id()
        ], 200);
    }

    public function postComment($id, Request $request){
        $createComment = CommentsMoments::create([
            'moment_id'=>$id,
            'user_id'=>Auth::id(),
            'comment'=>$request->comment
        ]);

        return response()->json([
            'success' => true,
            'message'=>'comment success posted'
        ], 200);
    }
}
