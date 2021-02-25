<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(CommentRequest $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $user = auth('api')->user();
        if($user->id = $comment->user_id){
            $comment->delete();
        }
        return response()->json([
            'message' => 'Comment successfully deleted'
        ]);
    }
}
