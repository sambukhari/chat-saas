@extends('layouts.neon')

@section('content')
<h3 class="neon-title mb-3">All Conversations</h3>

<div class="neon-card p-3">
<table class="table table-dark table-borderless">
<thead>
<tr>
    <th>ID</th>
    <th>Status</th>
    <th>Visitor</th>
</tr>
</thead>
<tbody>
@foreach($conversations as $chat)
<tr>
    <td>#{{ $chat->id }}</td>
    <td>{{ $chat->status }}</td>
    <td>{{ $chat->visitor_name }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection