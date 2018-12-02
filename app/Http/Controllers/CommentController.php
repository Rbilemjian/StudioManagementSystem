<?php

namespace App\Http\Controllers;

use App\Interfaces\CommentInterface;
use Illuminate\Http\Request;

//TODO: Dependency Injection, write basic CRUD functions

class CommentController extends Controller
{
    protected $ci = null;

    public function __construct(CommentInterface $ci)
    {
        $this->ci = $ci;
    }

    public function getAllComments()
    {
        return $this->ci->getAllComments();
    }

    public function createComment(Request $request)
    {
        $comment = [
            'text' => $request->text,
            'user' => $request->user,
            'payment_id' => $request->payment_id
        ];

        $this->ci->createComment($comment);
    }

    public function editComment(Request $request)
    {
        $edits = [
            'id' => $request->id,
            'text' => $request->text
        ];

        $this->ci->editComment($edits);
    }

    public function deleteComment(Request $request)
    {
        $id = $request->id;
        $this->ci->deleteComment($id);
    }
}
