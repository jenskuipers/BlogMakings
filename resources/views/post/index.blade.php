@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>{{ __('Post Index') }}</h3>
            
            @if(Auth::user())
                <a class="btn btn-secondary" href="{{ route('post.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th class="col-md-4">@sortablelink('title', __('Title'))</th>
                <th class="col-md-2">@sortablelink('user.name', __('Author'))</th>
                <th class="col-md-3">@sortablelink('created_at', __('Created at'))</th>
                <th class="col-md-3">@sortablelink('category.name', __('Category'))</th>
            </thead>
            
            @foreach($posts as $post)
            <tr>
                <td><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></td>
                <td><em><a href="{{ route('user.show', $post->user->id) }}">{{ $post->user->name }}</a></em></td>
                <td>{{ $post->created_at }}
                <td><a href="{{ route('category.show', $post->category->id) }}">{{ $post->category->name }}</a></td>
            </tr>
            @endforeach
        </table>
        
        <div class="d-flex justify-content-center">
            {!! $posts->appends(\Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection