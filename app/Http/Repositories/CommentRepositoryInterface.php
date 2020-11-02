<?php

namespace App\Repositories;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{   

    /**
     * Retrieve all comment instances by post ID.
     * 
     * @param   int                             $id
     * @return  Model|ModelNotFoundException
     */
    public function getAllByPostId($postId): LengthAwarePaginator;

    /**
     * Create comment instance with storeRequest.
     * 
     * @param   StoreCommentRequest    $request
     * @return  Comment
     */
    public function create(StoreCommentRequest $request): Comment;

    /**
     * Update comment instance with updateRequest.
     * 
     * @param   UpdateCommentRequest    $request
     * @param   Comment                 $comment
     * @return  Comment
     */
    public function update(UpdateCommentRequest $request, Comment $comment): Comment;

    /**
     * Destroy comment instance by ID.
     * 
     * @param   int     $commentId
     * @return  bool
     */
    public function destroy($commentId): bool;
}