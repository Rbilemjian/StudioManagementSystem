<?php

namespace App\Interfaces;

Interface CommentInterface
{
    public function getAllComments(): array;
    public function getPostComments(int $id);
    public function createComment(array $arr);
    public function deleteComment(int $id);
    public function editComment(array $arr);
}
