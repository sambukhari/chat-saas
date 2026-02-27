@extends('layouts.neon', ['title' => 'Create Site'])

@section('content')
<h3 class="neon-title mb-3">Add Site</h3>

<div class="neon-card p-4">
<form method="POST" action="{{ route('company.sites.store') }}">
    @csrf
    <div class="mb-3">
        <label>Domain</label>
        <input name="domain" class="form-control" placeholder="example.com" required>
    </div>
    <button class="btn btn-neon">Create</button>
</form>
</div>
@endsection