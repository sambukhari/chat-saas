@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Add Site for {{ $company->name }}</h2>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.sites.store', $company) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Domain</label>
                    <input type="text"
                           name="domain"
                           class="form-control"
                           placeholder="example.com"
                           required>
                </div>

                <button class="btn btn-dark">
                    Create Site
                </button>

                <a href="{{ route('admin.sites.index', $company) }}"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>
@endsection