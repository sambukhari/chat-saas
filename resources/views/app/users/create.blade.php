@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Create Agent</h2>

    <form method="POST" action="{{ route('app.users.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-dark">Create</button>

    </form>

</div>
@endsection