@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <h3>{{ __('User Index') }}</h3>
            
            @if(Auth::user())
                <a class="btn btn-secondary" href="{{ route('user.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th class="col-md-6">@sortablelink('name', __('Name'))</th>
                <th class="col-md-3">@sortablelink('email', __('E-mail Address'))</th>
                <th class="col-md-3">@sortablelink('role', __('Role'))</th>
                <th class="col-md-3">@sortablelink('created_at', __('Created at'))</th>
            </thead>

            @foreach($users as $user)
            <tr>
                <td><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ ucfirst($user->role) }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </table>
        
        <div class="d-flex justify-content-center">
            {!! $users->appends(\Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection
