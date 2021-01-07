<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\View;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Repositories\Eloquent\CategoryRepository;
use App\Http\Repositories\Eloquent\PostRepository;

class PostController extends Controller
{
    /**
     * @var PostRepository       $postRepository
     * @var PostRepository       $postRepository
     * @var CategoryRepository   $categoryRepository
     */
    protected $postRepository, $categoryRepository;

    /**
     * Instantiate the post and category repositories.
     *
     * @param PostRepository     $postRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository, PostRepository $postRepository) {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @var    Collection       $posts
     * @return \Illuminate\View
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @var    \App\Models\Category $category
     * @return \Illuminate\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();

        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $post = $this->postRepository->create($request);
        
        return redirect()
            ->route('post.show', $post->id)
            ->with('message', 'Post succesfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @var    Collection       $categories
     * @return \Illuminate\View
     */
    public function edit(Post $post)
    {
        $categories = $this->categoryRepository->getAll();

        return view('post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request     $request
     * @param  \App\Models\Post             $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = $this->postRepository->update($request, $post);

        return redirect()
            ->route('post.show', $post)
            ->with('message', 'Post succesfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post             $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->postRepository->destroy($post->id);

        return redirect()
            ->route('post.index')
            ->with('message', 'Post succesfully deleted.');
    }
}
