<?php

namespace App\Interfaces;

Interface CommentInterface
{
    public function getPostCommentsJSON(int $id);
    public function createComment(array $arr);
    public function deleteComment(int $id);
}
