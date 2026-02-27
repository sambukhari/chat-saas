@extends('layouts.neon')

@section('content')
<h3 class="neon-title mb-3">Agents</h3>

<a href="{{ route('company.agents.create') }}" class="btn btn-neon mb-3">+ Add Agent</a>

<div class="neon-card p-3">
<table class="table table-dark table-borderless">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($agents as $agent)
        <tr>
            <td>{{ $agent->name }}</td>
            <td>{{ $agent->email }}</td>
            <td>
                <form method="POST" action="{{ route('company.agents.destroy', $agent) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection