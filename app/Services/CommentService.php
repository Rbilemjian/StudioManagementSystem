<?php

namespace App\Services;
use App\Comment;
use App\Interfaces\CommentInterface;

class CommentService implements CommentInterface
{

    public function getAllComments(): array
    {
        return Comment::all()->toArray();
    }

    public function getPostComments(int $id)
    {
        return Comment::where('payment_id','=',$id)->get();
    }

    public function getPostCommentsJSON(int $id)
    {
        $comments = Comment::where('payment_id','=',$id)->get();
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

    public function editComment(array $edits)
    {
        $comment = Comment::find($edits['id']);
        $comment->text = $edits['text'];
        $comment->save();
    }

    public function deleteComment(int $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

}
