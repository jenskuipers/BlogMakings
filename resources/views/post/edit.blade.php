@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ __('Edit Post') }}</h3>
    </div>

    <div class="card-body">
    <form method="POST" action="{{ route('post.update', ['post' => $post]) }}">
            @csrf
            @method('patch')

            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" required autofocus>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                <div class="col-md-6">
                    <textarea id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content', $post->content) }}" required></textarea>

                    @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                <div class="col-md-6">
                    <select id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
