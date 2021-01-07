<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Http\Repositories\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Retrieve all comment instances by post ID.
     * 
     * @param   int                             $id
     * @return  Model|ModelNotFoundException
     */
    public function getAllByPostId($postId): LengthAwarePaginator
    {
        return Comment::sortable(['created_at' => 'desc'])
            ->where('post_id', '=', $postId)
            ->paginate(12);
    }

    /**
     * Create comment instance with storeRequest.
     * 
     * @param   StoreCommentRequest    $request
     * @return  Comment
     */
    public function create(StoreCommentRequest $request): Comment
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        return Comment::create($data);
    }

    /**
     * Update comment instance with updateRequest.
     * 
     * @param   UpdateCommentRequest    $request
     * @param   Comment                 $comment
     * @return  Comment
     */
    public function update(UpdateCommentRequest $request, Comment $comment): Comment
    {
        $comment->fill($request->validated());
        $comment->save();

        return $comment;
    }

    /**
     * Destroy comment instance by ID.
     * 
     * @param   int     $commentId
     * @return  bool
     */
    public function destroy($commentId): bool
    {
        return Comment::destroy($commentId);
    }

}