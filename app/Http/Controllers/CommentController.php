<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Repositories\Eloquent\CommentRepository;

class CommentController extends Controller
{
    /**
     * @var \App\Repositories\Eloquent\CommentRepository $commentRepository
     */
    protected $commentRepository;

    /**
     * Instantiate the comment repository.
     *
     * @param \App\Repositories\Eloquent\CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @var    \App\Models\Comment      $comment
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = $this->commentRepository->create($request);
        
        return redirect()
            ->route('post.show', $comment->post->id)
            ->with('message', 'Comment succesfully created.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request     $request
     * @param  \App\Models\Comment          $comment
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $post = $this->commentRepository->update($request, $comment);

        return redirect()
            ->route('post.show', $comment->post->id)
            ->with('message', 'Comment succesfully edited.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment             $comment
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $postId = $comment->post->id;

        $this->commentRepository->destroy($comment->id);

        return redirect()
            ->route('post.show', $postId)
            ->with('message', 'Comment succesfully deleted.');
    }
}
