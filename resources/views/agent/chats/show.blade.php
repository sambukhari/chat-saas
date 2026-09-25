@extends('layouts.neon')

@section('content')

@php
    $agent = auth('agent')->user();
    $agentAvatar = $agent->avatar ?? 'https://www.shutterstock.com/image-vector/ai-assistant-logo-friendly-robot-260nw-2630776459.jpg';
@endphp

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.dataset.currentConversationId = '{{ $conversation->id }}';
    document.body.dataset.currentSiteId = '{{ $conversation->site_id }}';
});
</script>

<div class="chat-header neon-card p-3 mb-3 d-flex justify-content-between align-items-center">
    <div>
        <strong>Conversation #{{ $conversation->id }}</strong>
    </div>

    <div id="chat-actions">
        @if(!$conversation->assigned_agent_id)
            <button id="join-btn" class="btn btn-success btn-sm">Join</button>
        @elseif($conversation->assigned_agent_id == $agent->id)
            <button id="leave-btn" class="btn btn-warning btn-sm">Leave</button>
        @else
            <span class="badge bg-secondary">Assigned to another agent</span>
        @endif
    </div>
</div>

<div id="chat-box"
     class="neon-card p-4 mb-3 chat-wrapper"
     data-conversation-id="{{ $conversation->id }}"
     data-last-id="{{ optional($conversation->messages->last())->id ?? 0 }}">

    @php $lastDate = null; @endphp

    @foreach($conversation->messages as $msg)
        @php
            $msgDate = $msg->created_at->format('Y-m-d');
        @endphp

        @if($lastDate !== $msgDate)
            @php
                $today = now()->startOfDay();
                $yesterday = now()->subDay()->startOfDay();
                $msgDay = $msg->created_at->copy()->startOfDay();
            @endphp

            <div class="date-divider" data-date="{{ $msg->created_at->toIso8601String() }}">
                @if($msgDay->equalTo($today))
                    Today
                @elseif($msgDay->equalTo($yesterday))
                    Yesterday
                @else
                    {{ $msg->created_at->format('d M Y') }}
                @endif
            </div>

            @php $lastDate = $msgDate; @endphp
        @endif

        <div class="chat-row {{ $msg->sender_type === 'agent' ? 'chat-agent' : ($msg->sender_type === 'system' ? 'chat-system' : 'chat-user') }}"
             data-id="{{ $msg->id }}"
             data-time="{{ $msg->created_at->toIso8601String() }}">

            @if($msg->sender_type !== 'system')
                <div class="avatar">
                    @if($msg->sender_type === 'agent')
                        <img src="{{ $agentAvatar }}" alt="Agent">
                    @else
                        <div class="user-circle">
                            <i class="fa fa-user"></i>
                        </div>
                    @endif
                </div>
            @endif

            <div class="{{ $msg->sender_type !== 'system' ? 'chat-bubble' : '' }}">
                <div class="chat-message">{{ $msg->message }}</div>
                <div class="chat-time">{{ $msg->created_at->format('H:i') }}</div>
            </div>
        </div>
    @endforeach
</div>

<form id="reply-form" method="POST" onsubmit="return false;">
    @csrf
    <div class="send_msg_wrap">
        <input id="agent-message"
               class="form-control"
               {{ $conversation->assigned_agent_id == $agent->id ? '' : 'disabled' }}
               placeholder="{{ $conversation->assigned_agent_id == $agent->id ? 'Type a message...' : 'Join chat first to send message' }}"
               required>
        <button type="button"
                id="send-btn"
                title="Send Message"
                class="btn btn-neon"
                {{ $conversation->assigned_agent_id == $agent->id ? '' : 'disabled' }}>
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</form>
@endsection

@push('after_styles_stack')
<style>
.chat-wrapper {
    max-height: 500px;
    overflow-y: auto;
    background: #ffffff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    font-family: 'Inter', sans-serif;
}
.chat-row {
    display: flex;
    margin-bottom: 18px;
    align-items: flex-end;
}
.chat-agent { justify-content: flex-end; }
.chat-user { justify-content: flex-start; }
.avatar {
    width: 40px;
    height: 40px;
    margin: 0 10px;
}
.avatar img,
.user-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.avatar img {
    object-fit: cover;
    border: 2px solid #0ea5e9;
}
.user-circle {
    background: #e0e7ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0f172a;
    font-size: 16px;
    font-weight: 500;
}
.chat-bubble {
    max-width: 65%;
    padding: 12px 16px;
    border-radius: 18px;
    position: relative;
    animation: fadeIn 0.25s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.chat-user .chat-bubble {
    background: #f3f4f6;
    color: #1f2937;
    border-bottom-left-radius: 4px;
}
.chat-agent .chat-bubble {
    background: #e0e7ff;
    color: #272343;
    border-bottom-right-radius: 4px;
}
.chat-time {
    font-size: 11px;
    margin-top: 6px;
    opacity: 0.6;
    text-align: right;
}
.chat-system .chat-time {
    text-align: center;
}
.date-divider {
    text-align: center;
    font-size: 12px;
    margin: 20px 0;
    color: #6b7280;
    position: relative;
}
.date-divider::before,
.date-divider::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #d1d5db;
}
.date-divider::before { left: 0; }
.date-divider::after { right: 0; }

@keyframes fadeIn {
    from { opacity:0; transform:translateY(5px);}
    to { opacity:1; transform:translateY(0);}
}

.chat-system {
    text-align: center;
    font-size: 13px;
    color: #6b7280;
    margin: 16px 0;
    position: relative;
    display: flex;
    flex-wrap: nowrap;
    align-content: center;
    justify-content: center;
    align-items: center;
}
</style>
@endpush

@push('after_scripts_stack')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const chatBox = document.getElementById("chat-box");
    const conversationId = Number(chatBox.dataset.conversationId);
    let lastMessageId = Number(chatBox.dataset.lastId || 0);

    let isJoined = {{ $conversation->assigned_agent_id == $agent->id ? 'true' : 'false' }};

    const messageInput = document.getElementById("agent-message");
    const sendBtn = document.getElementById("send-btn");
    const chatActions = document.getElementById("chat-actions");

    function scrollBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function enableInput() {
        isJoined = true;
        messageInput.disabled = false;
        sendBtn.disabled = false;
        messageInput.placeholder = "Type a message...";
    }

    function disableInput() {
        isJoined = false;
        messageInput.disabled = true;
        sendBtn.disabled = true;
        messageInput.placeholder = "Join chat first to send message";
    }

    function formatDateDivider(dateStr) {
        const msgDate = new Date(dateStr);
        const today = new Date();
        const yesterday = new Date();
        yesterday.setDate(today.getDate() - 1);

        const isSameDay = (d1, d2) =>
            d1.getFullYear() === d2.getFullYear() &&
            d1.getMonth() === d2.getMonth() &&
            d1.getDate() === d2.getDate();

        if (isSameDay(msgDate, today)) return "Today";
        if (isSameDay(msgDate, yesterday)) return "Yesterday";

        return msgDate.toLocaleDateString(undefined, {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text ?? '';
        return div.innerHTML;
    }

    function appendMessage(msg) {
        if (!msg || !msg.id) return;
        if (chatBox.querySelector('[data-id="' + msg.id + '"]')) return;

        const newDividerText = formatDateDivider(msg.created_at);
        const lastDivider = chatBox.querySelector(".date-divider:last-of-type");

        if (!lastDivider || lastDivider.innerText.trim() !== newDividerText) {
            const divider = document.createElement("div");
            divider.className = "date-divider";
            divider.innerText = newDividerText;
            chatBox.appendChild(divider);
        }

        const msgDate = new Date(msg.created_at);
        const time = msgDate.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        });

        const row = document.createElement("div");
        row.dataset.id = msg.id;
        row.dataset.time = msg.created_at;

        if (msg.sender_type === 'system') {
            row.className = "chat-row chat-system";
            row.innerHTML = `
                <div>
                    <div class="chat-message">${escapeHtml(msg.message)}</div>
                    <div class="chat-time">${time}</div>
                </div>
            `;
        } else if (msg.sender_type === 'agent') {
            row.className = "chat-row chat-agent";
            row.innerHTML = `
                <div class="avatar">
                    <img src="{{ $agentAvatar }}" alt="Agent">
                </div>
                <div class="chat-bubble">
                    <div class="chat-message">${escapeHtml(msg.message)}</div>
                    <div class="chat-time">${time}</div>
                </div>
            `;
        } else {
            row.className = "chat-row chat-user";
            row.innerHTML = `
                <div class="avatar">
                    <div class="user-circle"><i class="fa fa-user"></i></div>
                </div>
                <div class="chat-bubble">
                    <div class="chat-message">${escapeHtml(msg.message)}</div>
                    <div class="chat-time">${time}</div>
                </div>
            `;
        }

        chatBox.appendChild(row);
        lastMessageId = Math.max(lastMessageId, Number(msg.id));
        scrollBottom();
    }

    function fetchNewMessages() {
        fetch(`/agent/chats/${conversationId}/fetch-new?after_id=${lastMessageId}`)
            .then(r => r.json())
            .then(data => {
                if (!data || !data.messages) return;
                data.messages.forEach(appendMessage);
            });
    }

    function renderJoinButton() {
        chatActions.innerHTML = `<button id="join-btn" class="btn btn-success btn-sm">Join</button>`;
        bindJoinButton();
        disableInput();
    }

    function renderLeaveButton() {
        chatActions.innerHTML = `<button id="leave-btn" class="btn btn-warning btn-sm">Leave</button>`;
        bindLeaveButton();
        enableInput();
    }

    function bindJoinButton() {
        const joinBtn = document.getElementById("join-btn");
        if (!joinBtn) return;

        joinBtn.addEventListener("click", function () {
            fetch(`/agent/chats/${conversationId}/join`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(r => r.json())
            .then(() => {
                renderLeaveButton();
                messageInput.focus();
            });
        });
    }

    function bindLeaveButton() {
        const leaveBtn = document.getElementById("leave-btn");
        if (!leaveBtn) return;

        leaveBtn.addEventListener("click", function () {
            fetch(`/agent/chats/${conversationId}/leave`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(r => r.json())
            .then(() => {
                renderJoinButton();
            });
        });
    }

    if (sendBtn) {
        sendBtn.addEventListener("click", function () {
            if (!isJoined || messageInput.disabled) return;

            const message = messageInput.value.trim();
            if (!message) return;

            fetch(`/agent/chats/${conversationId}/reply`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ message: message })
            })
            .then(r => r.json())
            .then((data) => {
                messageInput.value = "";

                if (data && data.message) {
                    appendMessage(data.message);
                } else {
                    fetchNewMessages();
                }
            });
        });

        messageInput.addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                e.preventDefault();
                sendBtn.click();
            }
        });
    }

    window.addEventListener('agent-company-message', function (e) {
        const detail = e.detail || {};
        if (Number(detail.conversation_id || 0) === conversationId) {
            fetchNewMessages();
        }
    });

    scrollBottom();
    bindJoinButton();
    bindLeaveButton();
});
</script>
@endpush