@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Create Company</h2>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.companies.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Plan</label>
                    <select name="plan" class="form-select" required>
                        <option value="free">Free</option>
                        <option value="pro">Pro</option>
                        <option value="enterprise">Enterprise</option>
                    </select>
                    @error('plan')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="ai_enabled" value="1" class="form-check-input" id="ai_enabled">
                    <label class="form-check-label" for="ai_enabled">
                        Enable AI Support
                    </label>
                </div>

                <hr>

                <h5 class="mb-3">Company Admin User</h5>

                <div class="mb-3">
                    <label class="form-label">Admin Name</label>
                    <input type="text" name="admin_name" class="form-control" required>
                    @error('admin_name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Admin Email</label>
                    <input type="email" name="admin_email" class="form-control" required>
                    @error('admin_email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Admin Password</label>
                    <input type="password" name="admin_password" class="form-control" required>
                    @error('admin_password')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-dark">
                        Create Company
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection