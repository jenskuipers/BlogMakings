<?php

namespace App\Http\Repositories;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface
{   
    /**
     * Retrieve category instance by ID.
     * 
     * @param   int                             $id
     * @return  Model|ModelNotFoundException
     */
    public function getById($id): Category;

    /**
     * Retrieve all category instances.
     * 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator;

    /**
     * Retrieve all posts by category.
     * 
     * @param   Category                $category
     * @return  LengthAwarePaginator
     */
    public function getPostsByCategory(Category $category): LengthAwarePaginator;
    
    /**
     * Create category instance with storeRequest.
     * 
     * @param   StoreCategoryRequest    $request
     * @return  Category
     */
    public function create(StoreCategoryRequest $request): Category;

    /**
     * Update category instance with updateRequest.
     * 
     * @param   UpdateCategoryRequest   $request
     * @param   Category                $category
     * @return  Category
     */
    public function update(UpdateCategoryRequest $request, Category $category): Category;

    /**
     * Destroy category instance by ID.
     * 
     * @param   int     $categoryId
     * @return  bool
     */
    public function destroy($categoryId): bool;
}