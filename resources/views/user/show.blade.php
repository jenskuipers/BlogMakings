@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>{{ __('Profile') }}</h3>
            
            @if(Auth::user() && Auth::user()->can('update', $user))
            <a class="btn btn-secondary" href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
            @elseif(Auth::user() && Auth::user()->role == 'admin')
            <form method="post" action="{{ route('user.destroy', $user) }}">
                @csrf
                @method('delete')
                <div class="btn-group justify-content-end" role="group" aria-label="Options">
                    <a class="btn btn-secondary" href="{{ route('user.edit', $user) }}">{{ __('Edit') }}</a>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </div>
            </form>
            @endif
        </div>
    </div>
    
    <div class="card-body">
        <h3>{{ $user->name }}</h3>
        <p>{{ $user->email }}</p>
    </div>
</div>
@endsection
