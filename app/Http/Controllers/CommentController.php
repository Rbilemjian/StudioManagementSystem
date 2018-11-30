<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

//TODO: Dependency Injection, write basic CRUD functions

class CommentController extends Controller
{
    public function getAllComments()
    {
        return Comment::all();
    }
}
