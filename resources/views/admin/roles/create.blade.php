@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Create Role</h2>

    <form method="POST" action="{{ route('admin.roles.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Permissions</label>

            @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" 
                           name="permissions[]" 
                           value="{{ $permission->name }}" 
                           class="form-check-input">
                    <label class="form-check-label">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <button class="btn btn-dark">Create Role</button>
    </form>

</div>
@endsection