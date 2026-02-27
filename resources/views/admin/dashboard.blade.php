@extends('layouts.neon', ['title' => 'Admin Dashboard'])

@section('topbar')
<nav class="navbar topbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white neon-title" href="#">Admin</a>
        <div class="ms-auto d-flex gap-2">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-neon btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>
@endsection

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <div>
        <h3 class="neon-title mb-0">Platform Overview</h3>
        <div class="text-muted-neon small">Manage companies, plans, and global settings</div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-md-4">
        <div class="stat p-4">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted-neon">Companies</span>
                <span class="badge badge-soft">Total</span>
            </div>
            <div class="display-6 mt-2">{{ $companiesCount }}</div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="neon-card p-4">
            <h5 class="neon-title mb-2">Next Steps</h5>
            <ul class="text-muted-neon mb-0">
                <li>Create Companies</li>
                <li>Assign Plans</li>
                <li>Manage platform-wide permissions (later if needed)</li>
            </ul>
        </div>
    </div>
</div>
@endsection