<?php

namespace App\Services;
use App\Comment;
use App\Interfaces\CommentInterface;

class CommentService implements CommentInterface
{

    public function getPostCommentsJSON(int $id)
    {
        $comments = Comment::where('payment_id','=',$id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            "comments" => $comments
        ], 200);
    }

    public function createComment(array $arr)
    {
        $date = \Carbon\Carbon::now()->toDateString();
        $comment = new Comment([
            'text' => $arr['text'],
            'user' => $arr['user'],
            'payment_id' => $arr['payment_id']
        ]);
        $comment->save();
    }

    public function deleteComment(int $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

}
