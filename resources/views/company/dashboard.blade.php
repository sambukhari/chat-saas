@extends('layouts.neon', ['title' => 'Company Dashboard'])

@section('topbar')
<nav class="navbar topbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white neon-title" href="#">Company</a>
        <div class="ms-auto d-flex gap-2">
            <form method="POST" action="{{ route('company.logout') }}">
                @csrf
                <button class="btn btn-neon btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>
@endsection

@section('content')
<h3 class="neon-title mb-1">Tenant Dashboard</h3>
<p class="text-muted-neon mb-4">Sites, agents and chats are isolated by company_id</p>

<div class="row g-3">
    <div class="col-12 col-md-6">
        <div class="stat p-4">
            <div class="text-muted-neon">Open Conversations</div>
            <div class="display-6">{{ $openConversations }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="stat p-4">
            <div class="text-muted-neon">Closed Conversations</div>
            <div class="display-6">{{ $closedConversations }}</div>
        </div>
    </div>
</div>

<div class="neon-card p-4 mt-3">
    <h5 class="neon-title">Next build pages</h5>
    <div class="text-muted-neon small">
        /company/sites • /company/agents • /company/chats
    </div>
</div>
@endsection