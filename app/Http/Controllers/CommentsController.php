<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        $newComment = Comment::create($data);
        return response()->json($newComment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json([
            'message' => 'Comment successfully deleted'
        ]);
    }
}
