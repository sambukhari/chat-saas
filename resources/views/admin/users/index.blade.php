@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">All Users</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Roles</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->company?->name ?? '—' }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-info text-dark">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('admin.users.roles.edit', $user) }}"
                               class="btn btn-sm btn-primary">
                                Manage Roles
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection