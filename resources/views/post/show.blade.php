@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="font-weight-bolder">{{ $post->title }}</h3>
        
                @if((auth()->user() && auth()->user()->role == 'admin') ||
                    auth()->user() && auth()->user()->can('update', $post))
                    <form method="post" action="{{ route('post.destroy', $post) }}">
                        @csrf
                        @method('delete')
                        <div class="btn-group justify-content-end" role="group" aria-label="Options">
                            <a class="btn btn-secondary" href="{{ route('post.edit', $post) }}">{{ __('Edit') }}</a>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                        </div>
                    </form>
                @endif
            </div>
            {{ __('By') }} <em class="text-"><a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a></em> {{ $post->created_at }}
        </div>
        
        <div class="card-body">
            <p>{{ $post->content }}</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h3>{{ __('Comments') }}</h3>
        </div>
        
        <div class="card-body">
            <form method="post" action="{{ route('comment.store') }}">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" required></textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mb-4">
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        
            @forelse($post->comments as $comment)
                <div class="d-flex justify-content-between my-1">
                    <ul class="list-group mb-2 col-md-10">
                        <li class="list-group-item font-weight-bold">{{ $comment->user->name }}</li>
                        <li class="list-group-item">{{ $comment->content }}</li>
                    </ul>
                    @if((auth()->user() && auth()->user()->role == 'admin') ||
                        auth()->user() && auth()->user()->can('update', $comment))
                        <form class="col-md-2" method="post" action="{{ route('comment.destroy', $comment) }}">
                            @csrf
                            @method('delete')
                            <div class="btn-group justify-content-end" role="group" aria-label="Options">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                            </div>
                        </form>
                    @endif
                </div>
            @empty
                <p>{{ __('No comments yet.') }}</p>
            @endforelse
        </div>
    </div>
@endsection
