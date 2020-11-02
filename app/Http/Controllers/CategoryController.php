<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * Instantiate the category repository.
     * 
     * @param \App\Repositories\Eloquent\CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @var    Collection $categories
     * @return \Illuminate\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return View::make('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View
     */
    public function create()
    {
        return View::make('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Requests\StoreCategoryRequest  $request
     * @var    Category $category
     * @return \Illuminate\View
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request);
        
        return redirect()
            ->route('category.show', $category->id)
            ->with('message', 'Category succesfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @var    Collection $posts
     * @return \Illuminate\View
     */
    public function show(Category $category)
    {
        $posts = $this->categoryRepository->getPostsByCategory($category);

        return View::make('category.show', compact('category', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View
     */
    public function edit(Category $category)
    {
        return View::make('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @var    \App\Models\Category  $updatedCategory
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $updatedCategory = $this->categoryRepository->update($request, $category);

        return redirect()
            ->route('category.show', compact('category'))
            ->with('message', 'Category succesfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->destroy($category->id);

        return redirect()
            ->route('category.index')
            ->with('message', 'Category succesfully deleted.');
    }
}
