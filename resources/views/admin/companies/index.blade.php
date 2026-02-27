@extends('layouts.neon', ['title' => 'Companies'])

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Companies</h4>
    <a href="{{ route('admin.companies.create') }}" class="btn-brand">+ Add Company</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card-eze p-3">
    <div class="table-responsive">
        <table class="table table-dark align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Plan</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ ucfirst($company->plan) }}</td>
                    <td>
                        @if($company->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn-ghost btn-sm">Edit</a>

                        <form method="POST" action="{{ route('admin.companies.destroy', $company) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $companies->links() }}
</div>

@endsection