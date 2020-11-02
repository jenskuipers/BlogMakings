<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * Retrieve category instance by ID.
     * 
     * @param   int                             $id
     * @return  Model|ModelNotFoundException
     */
    public function getById($id): Category
    {
        try {
            return Category::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * Retrieve all category instances.
     * 
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return Category::sortable('name')
            ->paginate(12);
    }


    /**
     * Retrieve all posts by category.
     * 
     * @param   Category                $category
     * @return  LengthAwarePaginator
     */
    public function getPostsByCategory(Category $category): LengthAwarePaginator
    {
        return $category->posts()
            ->sortable(['updated_at' => 'desc'])
            ->paginate(12);
    }


    /**
     * Create category instance with storeRequest.
     * 
     * @param   StoreCategoryRequest    $request
     * @return  Category
     */
    public function create(StoreCategoryRequest $request): Category
    {
        $data = $request->validated();
        
        return Category::create($data);
    }

    /**
     * Update category instance with updateRequest.
     * 
     * @param   UpdateCategoryRequest   $request
     * @param   Category                $category
     * @return  Category
     */
    public function update(UpdateCategoryRequest $request, Category $category): Category
    {
        $category->fill($request->validated());
        $category->save();

        return $category;
    }

    /**
     * Destroy category instance by ID.
     * 
     * @param   int     $categoryId
     * @return  bool
     */
    public function destroy($categoryId): bool
    {
        return Category::destroy($categoryId);
    }

}