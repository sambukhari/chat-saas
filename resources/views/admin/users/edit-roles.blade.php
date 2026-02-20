@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Manage Roles for {{ $user->name }}</h2>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Assign Roles</label>

                    @foreach($roles as $role)
                        <div class="form-check">
                            <input type="checkbox"
                                   name="roles[]"
                                   value="{{ $role->name }}"
                                   class="form-check-input"
                                   {{ $user->hasRole($role->name) ? 'checked' : '' }}>

                            <label class="form-check-label">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <button class="btn btn-dark">Update Roles</button>

                <a href="{{ route('admin.users.index') }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>
@endsection