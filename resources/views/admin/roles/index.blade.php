@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h2>Roles</h2>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-dark">
            + Create Role
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @foreach($roles as $role)
                <div class="mb-3">
                    <h5>{{ $role->name }}</h5>
                    <div>
                        @foreach($role->permissions as $perm)
                            <span class="badge bg-info text-dark">
                                {{ $perm->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>

</div>
@endsection