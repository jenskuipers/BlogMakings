<?php

namespace App\Http\Repositories;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{   
    /**
     * Retrieve post instance by ID.
     * 
     * @param   int                             $id
     * @return  Model|ModelNotFoundException
     */
    public function getById($id): Post;

    /**
     * Retrieve all post instances.
     * 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * Retrieve all post instances by category ID.
     * 
     * @param   int                     $categoryId
     * @return  LengthAwarePaginator
     */
    public function getAllByCategoryId($categoryId): LengthAwarePaginator;

    /**
     * Retrieve all post instances by user ID.
     * 
     * @param   int                     $userId
     * @return  LengthAwarePaginator
     */
    public function getAllByUserId($userId): LengthAwarePaginator;

    /**
     * Create post instance with storeRequest.
     * 
     * @param   StorePostRequest    $request
     * @return  Post
     */
    public function create(StorePostRequest $request): Post;

    /**
     * Update post instance with updateRequest.
     * 
     * @param   UpdatePostRequest   $request
     * @param   Post                $post
     * @return  Post
     */
    public function update(UpdatePostRequest $request, Post $post): Post;

    /**
     * Destroy post instance by ID.
     * 
     * @param   int     $postId
     * @return  bool
     */
    public function destroy($postId): bool;
}