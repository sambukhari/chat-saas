@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h2>Chat Dashboard</h2>
    <div class="row">

        <!-- Chat List -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Open Chats
                </div>
                <div class="list-group list-group-flush" id="chatList">
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Conversation
                </div>
                <div class="card-body" style="height:400px; overflow-y:auto;" id="messagesBox">
                </div>
                <div class="card-footer d-flex">
                    <input type="text" id="messageInput" class="form-control me-2" placeholder="Type message...">
                    <button class="btn btn-primary" onclick="sendMessage()">Send</button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
let activeUuid = null;

function loadChats() {
    fetch('/agent/chats')
        .then(res => res.json())
        .then(data => {
            let list = document.getElementById('chatList');
            list.innerHTML = '';

            data.forEach(chat => {
                let item = document.createElement('a');
                item.href = "#";
                item.className = "list-group-item list-group-item-action";
                item.innerHTML = `
                    <strong>${chat.visitor_name ?? 'Visitor'}</strong>
                    <span class="badge bg-danger float-end">${chat.unread_count}</span>
                `;
                item.onclick = () => openChat(chat.uuid);
                list.appendChild(item);
            });
        });
}

function openChat(uuid) {
    activeUuid = uuid;

    fetch('/agent/messages/' + uuid)
        .then(res => res.json())
        .then(data => {
            let box = document.getElementById('messagesBox');
            box.innerHTML = '';

            data.reverse().forEach(msg => {
                let div = document.createElement('div');
                div.className = msg.sender_type === 'agent' ? 'text-end mb-2' : 'text-start mb-2';
                div.innerHTML = `<span class="badge bg-${msg.sender_type === 'agent' ? 'primary' : 'secondary'}">${msg.text}</span>`;
                box.appendChild(div);
            });
        });
}

function sendMessage() {
    let text = document.getElementById('messageInput').value;

    fetch('/agent/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            uuid: activeUuid,
            message: text
        })
    }).then(() => {
        document.getElementById('messageInput').value = '';
        openChat(activeUuid);
    });
}

loadChats();
setInterval(loadChats, 5000);
</script>
@endsection