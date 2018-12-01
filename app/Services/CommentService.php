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

    public function deletePayment(int $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

}