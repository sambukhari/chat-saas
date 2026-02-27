@extends('layouts.neon')

@section('content')

@php
    $agent = auth('agent')->user();
    $agentAvatar = $agent->avatar ?? 'https://www.shutterstock.com/image-vector/ai-assistant-logo-friendly-robot-260nw-2630776459.jpg';
@endphp

<div class="chat-header neon-card p-3 mb-3 d-flex justify-content-between align-items-center">

    <div>
        <strong>Conversation #{{ $conversation->id }}</strong>
    </div>

    <div id="chat-actions">

        @if(!$conversation->assigned_agent_id)
            <button id="join-btn"
                    class="btn btn-success btn-sm">
                Join
            </button>

        @elseif($conversation->assigned_agent_id == $agent->id)
            <button id="leave-btn"
                    class="btn btn-warning btn-sm">
                Leave
            </button>
        @else
            <span class="badge bg-secondary">
                Assigned to another agent
            </span>
        @endif

    </div>

</div>

<div id="chat-box"
     class="neon-card p-4 mb-3 chat-wrapper"
     data-conversation-id="{{ $conversation->id }}"
     data-last-id="{{ optional($conversation->messages->last())->id ?? 0 }}"
>

    @php
        $lastDate = null;
    @endphp

    @foreach($conversation->messages as $msg)

        @php
            $msgDate = $msg->created_at->format('Y-m-d');
        @endphp

        @if($lastDate !== $msgDate)
            @php
                $today = now()->startOfDay();
                $yesterday = now()->subDay()->startOfDay();
                $msgDay = $msg->created_at->startOfDay();
            @endphp

            <div class="date-divider"
                data-date="{{ $msg->created_at->toIso8601String() }}">

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

        <div class="chat-row {{ $msg->sender_type === 'agent' ? 'chat-agent' : 'chat-user' }}"
             data-id="{{ $msg->id }}"
             data-time="{{ $msg->created_at->toIso8601String() }}">

            <div class="avatar">
                @if($msg->sender_type === 'agent')
                    <img src="{{ $agentAvatar }}">
                @else
                    <div class="user-circle">
                        <i class="fa fa-user"></i>
                    </div>
                @endif
            </div>

            <div class="chat-bubble">
                <div class="chat-message">
                    {{ $msg->message }}
                </div>
                <div class="chat-time">
                    {{ $msg->created_at->format('H:i') }}
                </div>
            </div>

        </div>

    @endforeach

</div>


<form id="reply-form" method="POST">
    @csrf

    <div class="mb-3">
        <textarea id="agent-message"
                  class="form-control"
                  {{ $conversation->assigned_agent_id == $agent->id ? '' : 'disabled' }}
                  placeholder="{{ $conversation->assigned_agent_id == $agent->id ? 'Type a message...' : 'Join chat first to send message' }}"
                  required></textarea>
    </div>

    <button type="button"
            id="send-btn"
            class="btn btn-neon"
            {{ $conversation->assigned_agent_id == $agent->id ? '' : 'disabled' }}>
        Send
    </button>
</form>

@endsection


@push('after_styles_stack')
<style>
.chat-wrapper {
    max-height: 500px;
    overflow-y: auto;
    background: linear-gradient(145deg, #0f172a, #111827);
}

.chat-row {
    display: flex;
    margin-bottom: 18px;
    align-items: flex-end;
}

.chat-agent {
    justify-content: flex-end;
}

.chat-user {
    justify-content: flex-start;
}

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
    background: linear-gradient(135deg,#1e293b,#334155);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:16px;
}

.chat-bubble {
    max-width: 65%;
    padding: 12px 16px;
    border-radius: 18px;
    position: relative;
    animation: fadeIn 0.25s ease;
}

.chat-user .chat-bubble {
    background: #1f2937;
    color: #fff;
    border-bottom-left-radius: 4px;
}

.chat-agent .chat-bubble {
    background: linear-gradient(135deg,#0ea5e9,#2563eb);
    color: #fff;
    border-bottom-right-radius: 4px;
}

.chat-time {
    font-size: 11px;
    margin-top: 6px;
    opacity: 0.7;
    text-align: right;
}

.date-divider {
    text-align: center;
    font-size: 12px;
    margin: 20px 0;
    color: #94a3b8;
    position: relative;
}

.date-divider::before,
.date-divider::after {
    content: "";
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background: #334155;
}

.date-divider::before { left: 0; }
.date-divider::after { right: 0; }

@keyframes fadeIn {
    from { opacity:0; transform:translateY(5px);}
    to { opacity:1; transform:translateY(0);}
}
</style>
@endpush


@push('after_scripts_stack')
<script>
    
    document.addEventListener("DOMContentLoaded", function () {

        const chatBox = document.getElementById("chat-box");
        const conversationId = chatBox.dataset.conversationId;
        let lastMessageId = Number(chatBox.dataset.lastId || 0);

        let agentLastEventId = Number(localStorage.getItem('agent_last_event_id') || 0);
        let eventSource = null;

        function scrollBottom(){
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        scrollBottom();

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

        function appendMessage(msg){

            if (chatBox.querySelector(`[data-id="${msg.id}"]`)) return;

            const msgDate = new Date(msg.created_at);
            const dateKey = msgDate.toDateString();

            const lastDivider = chatBox.querySelector(".date-divider:last-of-type");
            const newDividerText = formatDateDivider(msg.created_at);

            if (!lastDivider || lastDivider.innerText !== newDividerText) {

                const divider = document.createElement("div");
                divider.className = "date-divider";
                divider.innerText = newDividerText;

                chatBox.appendChild(divider);
            }

            const row = document.createElement("div");
            row.className = "chat-row " + (msg.sender_type === 'agent' ? "chat-agent" : "chat-user");
            row.dataset.id = msg.id;

            row.innerHTML = `
                <div class="avatar">
                    ${msg.sender_type === 'agent'
                        ? '<img src="{{ $agentAvatar }}">'
                        : '<div class="user-circle"><i class="fa fa-user"></i></div>'}
                </div>

                <div class="chat-bubble">
                    <div>${msg.message}</div>
                    <div class="chat-time">
                        ${
                    const msgDate = new Date(msg.created_at);

const timeString = isNaN(msgDate.getTime())
    ? ''
    : msgDate.toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
                    }
                    </div>
                </div>
            `;

            chatBox.appendChild(row);
            lastMessageId = msg.id;
            scrollBottom();
        }

        function fetchNewMessages(){
            fetch(`/agent/chats/${conversationId}/fetch-new?after_id=${lastMessageId}`)
                .then(r=>r.json())
                .then(data=>{
                    if(!data.messages) return;
                    data.messages.forEach(appendMessage);
                });
        }

        function startSSE(){
            eventSource = new EventSource(`/agent/events?last_id=${agentLastEventId}`);

            eventSource.addEventListener("company_message", function(e){
                if(e.lastEventId){
                    agentLastEventId = Number(e.lastEventId);
                    localStorage.setItem('agent_last_event_id', agentLastEventId);
                }
                fetchNewMessages();
            });

            eventSource.onerror = function(){
                eventSource.close();
                setTimeout(startSSE,3000);
            };
        }

        startSSE();
        const joinBtn = document.getElementById("join-btn");
        const leaveBtn = document.getElementById("leave-btn");
        const sendBtn = document.getElementById("send-btn");
        const messageInput = document.getElementById("agent-message");

        function enableInput() {
            messageInput.disabled = false;
            sendBtn.disabled = false;
            messageInput.placeholder = "Type a message...";
        }

        function disableInput() {
            messageInput.disabled = true;
            sendBtn.disabled = true;
            messageInput.placeholder = "Join chat first to send message";
        }

        /* =========================
        JOIN CHAT
        ========================= */

        if (joinBtn) {
            joinBtn.addEventListener("click", function () {

                fetch(`/agent/chats/${conversationId}/join`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(r => r.json())
                .then(() => {

                    joinBtn.remove();

                    const leaveButton = document.createElement("button");
                    leaveButton.id = "leave-btn";
                    leaveButton.className = "btn btn-warning btn-sm";
                    leaveButton.innerText = "Leave";
                    document.getElementById("chat-actions").appendChild(leaveButton);

                    enableInput();

                    attachLeaveHandler(leaveButton);
                });
            });
        }

        /* =========================
        LEAVE CHAT
        ========================= */

        function attachLeaveHandler(button) {

            button.addEventListener("click", function () {

                fetch(`/agent/chats/${conversationId}/leave`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(r => r.json())
                .then(() => {

                    button.remove();

                    const joinButton = document.createElement("button");
                    joinButton.id = "join-btn";
                    joinButton.className = "btn btn-success btn-sm";
                    joinButton.innerText = "Join";
                    document.getElementById("chat-actions").appendChild(joinButton);

                    disableInput();

                    joinButton.addEventListener("click", arguments.callee);
                });
            });
        }

        if (leaveBtn) {
            attachLeaveHandler(leaveBtn);
        }

        /* =========================
        SEND MESSAGE (AJAX)
        ========================= */

        if (sendBtn) {

            sendBtn.addEventListener("click", function () {

                if (messageInput.disabled) return;

                const message = messageInput.value.trim();
                if (!message) return;

                fetch(`/agent/chats/${conversationId}/reply`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(r => r.json())
                .then(() => {
                    messageInput.value = "";
                });
            });
        }
    });
</script>
@endpush