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

    public function getPostCommentsJSON(Request $request)
    {
        $id = $request->id;
        return $this->ci->getPostCommentsJSON($id);
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

    public function deleteComment(Request $request)
    {
        $id = $request->id;
        $this->ci->deleteComment($id);
    }
}
