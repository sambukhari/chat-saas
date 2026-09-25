@extends('layouts.neon')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="neon-title mb-0">Chats <span class="badge bg-warning unread-badge">{{$site->domain}}</span></h3>

    <div>
        <span class="me-2 text-muted">Total Unread</span>
        <span class="badge bg-danger fs-6" id="global-unread">
            {{ $totalUnread }}
        </span>
    </div>
</div>


<div class="mb-4">
    <a href="?site={{request()->site}}&status=open"
       class="btn {{ $status=='open' ? 'btn-neon' : 'btn-outline-light' }} me-2">
        Open Chats
    </a>

    <a href="?site={{request()->site}}&status=closed"
       class="btn {{ $status=='closed' ? 'btn-neon' : 'btn-outline-light' }}">
        Closed Chats
    </a>
</div>


<div class="neon-card">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0" id="chat-table">
            <thead>
                <tr>
                    <th>Date</th>
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
                    <td>
                         <div class="fw-bold">
                           {{ $lastMessage->created_at->isToday() 
                    ? 'Today ' 
                    : ($lastMessage->created_at->isYesterday() 
                        ? 'Yesterday ' 
                        : $lastMessage->created_at->format('F d, Y')) }}
                        </div>
                         <small class="text-muted">
                            {{ $lastMessage->created_at->format('H:i') }}
                        </small>
                    </td>

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
         <div class="table-pagination" id="table-pagination" style="display:none;">
        <button class="tp-btn" id="table-prev"><i class="fa fa-chevron-left"></i></button>
        <span class="tp-info" id="table-info">1 / 1</span>
        <button class="tp-btn" id="table-next"><i class="fa fa-chevron-right"></i></button>
    </div>
    </div>
</div>

@endsection
<style>
    .table-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px;
    background: transparent;
}

.table-pagination .tp-btn {
    background: gray;
    border: none;
    color: #fff;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    font-size: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.25s;
}

.table-pagination .tp-btn:hover:not(:disabled) {
    background: #0074a3;
    color: #fff;
}

.table-pagination .tp-btn:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

.table-pagination .tp-info {
    font-size: 13px;
    color: #666;
    min-width: 60px;
    text-align: center;
    font-weight: 500;
}
</style>

@push('after_scripts_stack')
<script>
var _tablePage = 1;
var PER_TABLE = 8;

function applyTablePagination() {
    var tbody = document.querySelector('#chat-table tbody');
    var paginationEl = document.getElementById('table-pagination');
    var prevBtn = document.getElementById('table-prev');
    var nextBtn = document.getElementById('table-next');
    var infoEl = document.getElementById('table-info');

    if (!tbody) return;

    var rows = Array.from(tbody.querySelectorAll('tr')).filter(function(row) {
        return !row.querySelector('td[colspan]'); // skip "no chats found" row
    });

    var total = rows.length;
    var totalPages = Math.max(1, Math.ceil(total / PER_TABLE));

    _tablePage = Math.min(_tablePage, totalPages);
    var start = (_tablePage - 1) * PER_TABLE;

    // Hide all rows first
    tbody.querySelectorAll('tr').forEach(function(row) {
        row.style.display = 'none';
    });

    // Show only current page rows
    rows.forEach(function(row, i) {
        row.style.display = (i >= start && i < start + PER_TABLE) ? '' : 'none';
    });

    paginationEl.style.display = totalPages > 1 ? 'flex' : 'none';
    infoEl.textContent = _tablePage + ' / ' + totalPages;
    prevBtn.disabled = _tablePage === 1;
    nextBtn.disabled = _tablePage === totalPages;
}

document.addEventListener('DOMContentLoaded', function() {
    var prevBtn = document.getElementById('table-prev');
    var nextBtn = document.getElementById('table-next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (_tablePage > 1) { _tablePage--; applyTablePagination(); }
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            _tablePage++; applyTablePagination();
        });
    }

    applyTablePagination();
});
</script>
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