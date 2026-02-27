@extends('layouts.neon')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="neon-title mb-0">Chats</h3>

    <div>
        <span class="me-2 text-muted">Total Unread</span>
        <span class="badge bg-danger fs-6" id="global-unread">
            {{ $totalUnread }}
        </span>
    </div>
</div>


<div class="mb-4">
    <a href="?status=open"
       class="btn {{ $status=='open' ? 'btn-neon' : 'btn-outline-light' }} me-2">
        Open Chats
    </a>

    <a href="?status=closed"
       class="btn {{ $status=='closed' ? 'btn-neon' : 'btn-outline-light' }}">
        Closed Chats
    </a>
</div>


<div class="neon-card p-4">

    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0" id="chat-table">
            <thead>
                <tr>
                    <th>UUID</th>
                    <th>Visitor</th>
                    <th>Last Message</th>
                    <th>Status</th>
                    <th class="text-center">Unread</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>

            <tbody>

                @forelse($conversations as $conversation)

                @php
                    $lastMessage = $conversation->messages->last();
                @endphp

                <tr data-id="{{ $conversation->id }}">
                    <td>{{ $conversation->uuid }}</td>

                    <td>
                        <div class="fw-bold">
                            {{ $conversation->visitor_name ?? 'Visitor' }}
                        </div>
                        <small class="text-muted">
                            {{ $conversation->visitor_email ?? '—' }}
                        </small>
                    </td>

                    <td style="max-width:250px;">
                        @if($lastMessage)
                            <span class="text-truncate d-inline-block" style="max-width:250px;">
                                {{ \Illuminate\Support\Str::limit($lastMessage->message, 60) }}
                            </span>
                        @else
                            <span class="text-muted">No messages yet</span>
                        @endif
                    </td>

                    <td>
                        @if($conversation->status === 'open')
                            <span class="badge bg-success">Open</span>
                        @else
                            <span class="badge bg-secondary">Closed</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($conversation->unread_count > 0)
                            <span class="badge bg-warning unread-badge">
                                {{ $conversation->unread_count }}
                            </span>
                        @else
                            <span class="text-muted">0</span>
                        @endif
                    </td>

                    <td class="text-end">
                        <a href="{{ route('agent.chats.show', $conversation) }}"
                           class="btn btn-sm btn-neon">
                            Open
                        </a>
                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        No chats found.
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection


@push('after_scripts_stack')
<script>
document.addEventListener("DOMContentLoaded", function () {

    let agentLastEventId = Number(localStorage.getItem('agent_last_event_id') || 0);
    let eventSource = null;

    function refreshChatTable() {

        fetch(window.location.href, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.text())
        .then(html => {

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newTable = doc.querySelector('#chat-table tbody');
            const newGlobal = doc.querySelector('#global-unread');

            if (newTable)
                document.querySelector('#chat-table tbody').innerHTML = newTable.innerHTML;

            if (newGlobal)
                document.querySelector('#global-unread').innerText = newGlobal.innerText;
        });
    }

    function startAgentSSE() {

        if (eventSource) {
            eventSource.close();
            eventSource = null;
        }

        eventSource = new EventSource(`/agent/events?last_id=${agentLastEventId}`);

        eventSource.addEventListener("company_message", function (e) {

            if (e.lastEventId) {
                agentLastEventId = Number(e.lastEventId);
                localStorage.setItem('agent_last_event_id', agentLastEventId);
            }

            refreshChatTable();
        });

        eventSource.onerror = function () {
            if (eventSource) {
                eventSource.close();
                eventSource = null;
            }
            setTimeout(startAgentSSE, 3000);
        };
    }

    startAgentSSE();

});
</script>
@endpush