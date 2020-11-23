@extends('layouts.app')

@section('content')
<div class="card mb-5">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>{{ $category->name }}</h3>

            @if(auth()->user() && (auth()->user()->role == 'admin'))
                <form method="post" action="{{ route('category.destroy', $category) }}">
                    @csrf
                    @method('delete')
                    <div class="btn-group justify-content-end" role="group" aria-label="Options">
                        <a class="btn btn-secondary" href="{{ route('category.edit', $category) }}">{{ __('Edit') }}</a>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </div>
                </form>
            @endif
        </div>
        <p>{{ $category->description }}</p>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th class="col-md-6">@sortablelink('title', __('Title'))</th>
                <th class="col-md-3">@sortablelink('user.name', __('Author'))</th>
                <th class="col-md-3">@sortablelink('created_at', __('Created at'))</th>
            </thead>

            @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></td>
                <td><em><a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a></em></td>
                <td>{{ $post->updated_at }}
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
