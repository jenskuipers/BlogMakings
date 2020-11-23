<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Retrieve post instance by ID.
     * 
     * @param   int                             $id
     * @return  Model|ModelNotFoundException
     */
    public function getById($id): Post
    {
        try {
            return Post::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }
        
    }

    /**
     * Retrieve all post instances.
     * 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return Post::sortable(['title' => 'desc'])
            ->paginate(12);
    }

    /**
     * Retrieve all post instances by category ID.
     * 
     * @param   int                     $categoryId
     * @return  LengthAwarePaginator
     */
    public function getAllByCategoryId($categoryId): LengthAwarePaginator
    {
        return Post::sortable(['title' => 'desc'])
            ->where('category_id', '=', $categoryId)
            ->paginate(12);
    }

    /**
     * Retrieve all post instances by user ID.
     * 
     * @param   int                     $userId
     * @return  LengthAwarePaginator
     */
    public function getAllByUserId($userId): LengthAwarePaginator
    {
        return Post::sortable(['title' => 'desc'])
            ->whereUserId($userId)
            ->paginate(12);
    }

    /**
     * Create post instance with storeRequest.
     * 
     * @param   StorePostRequest    $request
     * @return  Post
     */
    public function create(StorePostRequest $request): Post
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        
        return Post::create($data);
    }

    /**
     * Update post instance with updateRequest.
     * 
     * @param   UpdatePostRequest   $request
     * @param   Post                $post
     * @return  Post
     */
    public function update(UpdatePostRequest $request, Post $post): Post
    {
        $post->fill($request->validated());
        $post->save();

        return $post;
    }

    /**
     * Destroy post instance by ID.
     * 
     * @param   int     $postId
     * @return  bool
     */
    public function destroy($postId): bool
    {
        return Post::destroy($postId);
    }

}