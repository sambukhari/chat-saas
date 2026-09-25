@extends('layouts.neon', ['title' => 'Agent Dashboard'])

@section('topbar')
<nav class="navbar topbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white neon-title" href="#">Agent</a>
        <div class="ms-auto d-flex gap-2">
            <form method="POST" action="{{ route('agent.logout') }}">
                @csrf
                <button class="btn btn-neon btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>
@endsection

@section('content')
<h3 class="neon-title mb-1">Support Console</h3>
<p class="text-muted-neon mb-4">You can only see chats for your own company</p>

<div class="row g-3">
    <div class="col-12 col-md-6">
        <div class="stat p-4">
            <div class="text-muted-neon">My Open Tickets</div>
            <div class="display-6">{{ $myOpen }}</div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="stat p-4">
            <div class="text-muted-neon">Unassigned Open</div>
            <div class="display-6">{{ $unassignedOpen }}</div>
        </div>
    </div>
</div>

<div class="neon-card p-4">
    <h5 class="neon-title">Next build pages</h5>
    <div class="text-muted-neon small">
        /agent/chats • join • reply • close
    </div>
</div>
@endsection