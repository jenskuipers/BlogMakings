@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>{{ __('Category Index') }}</h3>

            @if(Auth::user())
                <a class="btn btn-secondary" href="{{ route('category.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th>@sortablelink('name', __('Name'))</th>
            </thead>

            @foreach($categories as $category)
            <tr>
                <td><a href="{{ route('category.show', $category) }}">{{ $category->name }}</a></td>
            </tr>
            @endforeach
        </table>
        
        <div class="d-flex justify-content-center">
            {!! $categories->appends(\Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection
