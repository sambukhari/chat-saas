@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Edit User</h2>

    <form method="POST" action="{{ route('app.users.update',$user) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input class="form-control" name="name" value="{{ $user->name }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input class="form-control" name="email" value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label>New Password (optional)</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select class="form-select" name="role">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}"
                        {{ $user->roles->first()?->name === $role->name ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-dark">Update</button>

    </form>

</div>
@endsection