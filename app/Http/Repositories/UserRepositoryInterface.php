<?php

namespace App\Http\Repositories;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{   
    /**
     * Retrieve user instance by ID.
     * 
     * @param int $id
     * @return Model|ModelNotFoundException
     */
    public function getById($id): User;

    /**
     * Retrieve all user instances.
     * 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * Retrieve all posts by iser.
     * 
     * @param   User                    $user
     * @return  LengthAwarePaginator
     */
    public function getPostsByUser(User $user): LengthAwarePaginator;
    
    /**
     * Create user instance with storeRequest.
     * 
     * @param   StoreUserRequest    $request
     * @return  User
     */
    public function create(StoreUserRequest $request): User;

    /**
     * Update user instance with updateRequest.
     * 
     * @param   UpdateUserRequest   $request
     * @param   User                $category
     * @return  USer
     */
    public function update(UpdateUserRequest $request, User $user): ?User;

    /**
     * Destroy user instance by ID.
     * 
     * @param   int     $userId
     * @return  bool
     */
    public function destroy($userId): bool;
}