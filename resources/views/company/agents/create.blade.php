@extends('layouts.neon')

@section('content')
<h3 class="neon-title mb-3">Create Agent</h3>

<div class="neon-card p-4">
<form method="POST" action="{{ route('company.agents.store') }}">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>

    <button class="btn btn-neon">Create</button>
</form>
</div>
@endsection