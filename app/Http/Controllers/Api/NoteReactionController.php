<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DislikesMoments;
use App\Models\LikesMoments;
use App\Models\Moment;
use Illuminate\Support\Facades\Auth;

class NoteReactionController extends Controller
{
    public function like($id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userId = Auth::id();
        $message ="";
        $condition = false;
        $moment = Moment::findOrFail($id);

        $existingLike = LikesMoments::where('moment_id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$existingLike) { //jika belum ada
            LikesMoments::create([
                'moment_id' => $id,
                'user_id' => $userId
            ]);

            $moment->increment('likes');
            $message = 'like successfully added';
            $condition = true;

            //hapus dislike
            $existingDislike = DislikesMoments::where('moment_id', $id)
                ->where('user_id',$userId)->first();

            if($existingDislike){
                if($moment->dislikes > 0){
                    $moment->decrement('dislikes');
                }
                $existingDislike->delete();
            }
        }else{
            $existingLike->delete();

            if ($moment->likes > 0) { //biar gak minus
                $moment->decrement('likes');
            }

            $message = 'like successfully removed';
            $condition = false;
        }

        return response()->json([
            'status'=>'success',
            'message'=>$message,
            'like_count'=>$moment->likes,
            'dislike_count'=>$moment->dislikes,
            'condition'=> $condition
        ], 200);
    }

    public function dislike($id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userId = Auth::id();
        $message ="";
        $condition = false;
        $moment = Moment::findOrFail($id);

        $existingDislike = DislikesMoments::where('moment_id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$existingDislike) { //jika belum ada
            DislikesMoments::create([
                'moment_id' => $id,
                'user_id' => $userId
            ]);

            $moment->increment('dislikes');
            $message = 'dislike successfully added';
            $condition = true;

            //hapus likes
            $existingLike = LikesMoments::where('moment_id', $id)
                ->where('user_id',$userId)->first();

            if($existingLike){
                if($moment->likes > 0){
                    $moment->decrement('likes');
                }
                $existingLike->delete();
            }
        }else{
            $existingDislike->delete();

            if ($moment->dislikes > 0) { //biar gak minus
                $moment->decrement('dislikes');
            }

            $message = 'dislike successfully removed';
            $condition = false;
        }

        return response()->json([
            'status'=>'success',
            'message'=>$message,
            'like_count'=>$moment->likes,
            'dislike_count'=>$moment->dislikes,
            'condition'=> $condition
        ], 200);
    }
}
