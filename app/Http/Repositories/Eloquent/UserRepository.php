<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Http\Repositories\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Retrieve user instance by ID.
     * 
     * @param int $id
     * @return Model|ModelNotFoundException
     */
    public function getById($id): User
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }
        
    }

    /**
     * Retrieve all user instances.
     * 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return User::sortable('name')
            ->paginate(12);
    }

    /**
     * Retrieve all posts by iser.
     * 
     * @param   User                    $user
     * @return  LengthAwarePaginator
     */
    public function getPostsByUser(User $user): LengthAwarePaginator
    {
        return $user->posts()
            ->sortable(['updated_at' => 'desc'])
            ->paginate(12);
    }

    /**
     * Create user instance with storeRequest.
     * 
     * @param   StoreUserRequest    $request
     * @return  User
     */
    public function create(StoreUserRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        
        return User::create($data);
    }

    /**
     * Update user instance with updateRequest.
     * 
     * @param   UpdateUserRequest   $request
     * @param   User                $category
     * @return  USer
     */
    public function update(UpdateUserRequest $request, User $user): ?User
    {
        $user->fill($request->validated());
        $user->save();

        return $user;
    }

    /**
     * Destroy user instance by ID.
     * 
     * @param   int     $userId
     * @return  bool
     */
    public function destroy($userId): bool
    {
        return User::destroy($userId);
    }

}