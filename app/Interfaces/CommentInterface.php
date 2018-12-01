<?php

namespace App\Interfaces;

Interface CommentInterface
{
    public function getAllComments(): array;
    public function createComment(array $arr);
    public function deletePayment(int $id);
}