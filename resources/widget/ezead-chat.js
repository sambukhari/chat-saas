(function () {

    /* ============================================================
       CONFIG
    ============================================================ */

    const scriptTag = document.currentScript;
    if (!scriptTag) return;
    let widgetValid = true;
    let widgetName = "Ezead";
    const WIDGET_KEY = scriptTag.getAttribute("data-widget-key");
    if (!WIDGET_KEY) return;

    const BASE_URL = new URL(scriptTag.src).origin;
    const API_BASE = BASE_URL + "/api/widget";

    /* ============================================================
       STATE
    ============================================================ */

    let conversationUuid = localStorage.getItem("ezead_uuid");
    let lastEventId = Number(localStorage.getItem("ezead_last_event_id") || 0);
    let lastMessageId = 0;
    let eventSource = null;
    const seenMessageIds = new Set();
    let lastRenderedDateKey = null;
    let initialLoad = true;

    /* ============================================================
    SOUND
    ============================================================ */

    const messageSound = new Audio(BASE_URL + "/sounds/message.mp3");
    messageSound.preload = "auto";

    function playMessageSound() {
        messageSound.currentTime = 0;
        messageSound.play().catch(()=>{});
    }

    /* ============================================================
       DOM HELPERS
    ============================================================ */

    function qs(id) {
        return document.getElementById(id);
    }

    function create(tag, cls) {
        const el = document.createElement(tag);
        if (cls) el.className = cls;
        return el;
    }

    /* ============================================================
       API HELPERS
    ============================================================ */

    function apiUrl(path, params = {}) {
        const url = new URL(API_BASE + path);
        url.searchParams.set("key", WIDGET_KEY);
        Object.keys(params).forEach(k => {
            if (params[k] !== undefined && params[k] !== null)
                url.searchParams.set(k, params[k]);
        });
        return url.toString();
    }

    function showInvalidWidgetMessage(message) {
        const form = qs("sc-form");

        form.innerHTML = `
            <div style="text-align:center; padding:30px;">
                <h3 style="color:#dc2626;">⚠ Chat Unavailable</h3>
                <p style="color:#6b7280; font-size:14px; margin-top:10px;">
                    ${escapeHtml(message)}
                </p>
            </div>
        `;
    
    }

    function apiGet(path, params) {
        return fetch(apiUrl(path, params)).then(r => r.json());
    }

    function apiPost(path, body) {
        return fetch(apiUrl(path), {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(body || {})
        }).then(r => r.json());
    }

    /* ============================================================
       CSS INJECTION
    ============================================================ */

    const style = create("style");
    style.innerHTML = `
#sc-header button {
    background: rgba(255, 255, 255, 0.15);
    border: none;
    color: white;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}
@media(max-width:480px){#sc-box{width:calc(100vw - 20px);height:calc(100vh - 140px)}}
#sc-widget {
        position: fixed;
        bottom: 60px;
        right: 5px;
        z-index: 9999;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* System message */
    .sc-system {
        max-width: 100%;
        margin: 12px auto;
        padding: 8px 14px;
        font-size: 12px;
        color: #6b7280;
        text-align: center;
        background: #f3f4f6;
        border-radius: 8px;
    }

    /* Time under system message */
    .sc-system .sc-time {
        font-size: 11px;
        margin-top: 2px;
        color: #9ca3af;
    }

    .sc-error {
        border-color: #dc2626 !important;
    }

    .sc-error-text {
        color: #dc2626;
        font-size: 12px;
        margin-top: 4px;
    }


    /* Floating button */
    #sc-toggle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0074a3, #005a7d);
        color: white;
        border: none;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(0, 116, 163, 0.35);
        font-size: 24px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #sc-toggle:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 116, 163, 0.45);
    }

    #sc-toggle:active {
        transform: translateY(-1px);
    }
    #sc-toggle img.chat-icon {
        width: 28px;
        height: 28px;
        object-fit: contain;
    }
    #sc-close img.close-chat-icon {
        width: 12px;
        height: 12px;
        object-fit: contain;
    }
    /* Chat box */
    #sc-box {
        width: 360px;
        height: 520px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        display: none;
        flex-direction: column;
        overflow: hidden;
        margin-bottom: 12px;
    }

    /* Header */
    #sc-header {
        background: linear-gradient(135deg, #0074a3, #005a7d);
        color: white;
        padding: 18px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    #sc-header h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 4px 0;
    }

    #sc-header small {
        font-size: 13px;
        opacity: 0.9;
    }

    #sc-header button {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: white;
        cursor: pointer;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    #sc-header button:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* Messages */
    #sc-messages {
        flex: 1;
        padding: 16px;
        overflow-y: auto;
        background: #fff;
    }

    #sc-messages::-webkit-scrollbar {
        width: 6px;
    }

    #sc-messages::-webkit-scrollbar-track {
        background: transparent;
    }

    #sc-messages::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }

    #sc-messages::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }

    /* Date separator */
    .sc-date-sep {
        text-align: center;
        font-size: 12px;
        color: #6b7280;
        margin: 16px 0;
        user-select: none;
        font-weight: 500;
    }

    /* Message bubbles */
    .sc-msg {
        max-width: 75%;
        margin-bottom: 10px;
        padding: 10px 14px;
        border-radius: 16px;
        font-size: 14px;
        line-height: 1.5;
        word-break: break-word;
    }

    .sc-user {
        background: linear-gradient(135deg, #0074a3, #005a7d);
        color: white;
        margin-left: auto;
        border-bottom-right-radius: 4px;
    }

    .sc-agent {
        background: #e5e7eb;
        color: #111827;
        margin-right: auto;
        border-bottom-left-radius: 4px;
    }

    /* Time under bubble */
    .sc-time {
        font-size: 11px;
        margin-top: 6px;
        opacity: 0.8;
        user-select: none;
    }

    .sc-user .sc-time {
        color: rgba(255, 255, 255, 0.9);
        text-align: right;
    }

    .sc-agent .sc-time {
        color: #6b7280;
        text-align: left;
    }

    /* Guest form */
    #sc-form {
        padding: 24px 20px;
        background: #fff;
    }

    #sc-form h3 {
        font-size: 22px;
        color: #111827;
        margin-bottom: 8px;
        text-align: center;
    }

    #sc-form h4 {
        font-size: 16px;
        color: #374151;
        margin-bottom: 16px;
        text-align: center;
        font-weight: 500;
    }

    #sc-form p {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 20px;
        text-align: center;
        line-height: 1.6;
    }

    #sc-form input {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 12px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        font-size: 14px;
        transition: all 0.3s ease;
        outline: none;
    }

    #sc-form input:focus {
        border-color: #0074a3;
        box-shadow: 0 0 0 3px rgba(0, 116, 163, 0.1);
    }

    #sc-form input::placeholder {
        color: #9ca3af;
    }

    #sc-form button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #0074a3, #005a7d);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    #sc-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 116, 163, 0.3);
    }

    #sc-form button:active {
        transform: translateY(0);
    }

    /* Message input */
    #sc-input {
        padding: 14px;
        border-top: 1px solid #e5e7eb;
        display: none;
        gap: 8px;
        background: #fff;
    }

    #sc-input input {
        flex: 1;
        padding: 11px 16px;
        border-radius: 24px;
        border: 2px solid #e5e7eb;
        font-size: 14px;
        outline: none;
        transition: all 0.3s ease;
    }

    #sc-input input:focus {
        border-color: #0074a3;
        box-shadow: 0 0 0 3px rgba(0, 116, 163, 0.1);
    }
    .signature {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        padding-bottom: 12px;
        font-size: 12px;
        height: 20px;
    }

    #sc-input button {
        background: linear-gradient(135deg, #0074a3, #005a7d);
        border: none;
        color: white;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    #sc-input button:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 116, 163, 0.3);
    }

    #sc-input button:active {
        transform: scale(0.98);
    }

    /* Message row */
    .sc-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
    }

    .sc-row.sc-user-row {
        flex-direction: row-reverse;
    }

    /* Avatar */
    .sc-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #9ca3af;
        color: white;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        user-select: none;
        font-weight: 600;
    }

    .sc-avatar.agent {
        background: linear-gradient(135deg, #0074a3, #005a7d);
    }

    .sc-avatar.user {
        background: linear-gradient(135deg, #0074a3, #005a7d);
        font-size: 11px;
    }

    .sc-avatar.system {
        background: #6b7280;
    }

    /* Name label */
    .sc-name {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #374151;
    }

    .sc-user .sc-name {
        text-align: right;
        color: rgba(255, 255, 255, 0.95);
    }

    /* Mobile Responsive */
    @media (max-width: 480px) {
        #sc-box {
            width: calc(100vw - 20px);
            height: calc(100vh - 140px);
            max-width: 360px;
        }
    }
`;
    document.head.appendChild(style);

    /* ============================================================
       HTML INJECTION
    ============================================================ */

    const widget = create("div");
    widget.id = "sc-widget";
    widget.innerHTML = `
<button id="sc-toggle" aria-label="Open Chat" onclick="toggleChat()">
    <img src="https://chat.ezead.com/images/chat.png" alt="Chat" class="chat-icon">
</button>
<div id="sc-box">
    <div id="sc-header">
        <div>
            <strong id="company_name">${widgetName}</strong><br>
            <small>We are here to help</small>
        </div>
        <button id="sc-close" aria-label="Close Chat">
            <img src="https://chat.ezead.com/images/cancel.png" alt="Chat Close" class="close-chat-icon">
        </button>
    </div>
    <div id="sc-messages"></div>
    <div id="sc-form">
        <h3>Hi there 👋</h3>
        <h4>How can we help you?</h4>
        <p>To start the chat, please provide your name and email. Our support team will be with you shortly!</p>
        <input id="g-name" placeholder="Your name">
        <input id="g-email" placeholder="Email address">
        <button id="start-chat">Start Chat</button>
    </div>
    <div id="sc-input">
        <input id="chat-text" placeholder="Type message...">
        <button id="send-msg">➤</button>
    </div>
    <p class="signature"><span> Powered By: <a href="https://ezeadmedia.com/"> EzeAd Media Group </a> <span></p>
</div>

`;
    document.body.appendChild(widget);

    /* ============================================================
       UI FUNCTIONS
    ============================================================ */

    function toggleChat() {
        const box = qs("sc-box");
        box.style.display = box.style.display === "flex" ? "none" : "flex";
    }

    qs("sc-toggle").onclick = toggleChat;
    qs("sc-close").onclick = toggleChat;

    // function addMessage(msg) {
    //     if (msg.id && seenMessageIds.has(msg.id)) return;
    //     if (msg.id) seenMessageIds.add(msg.id);

    //     const box = qs("sc-messages");
    //     const div = create("div", "sc-msg " + (msg.from === "user" ? "sc-user" : "sc-agent"));
    //     div.textContent = msg.text;
    //     box.appendChild(div);
    //     box.scrollTop = box.scrollHeight;
    //     lastMessageId = msg.id;
    // }
     function addMessage(msg) {
        const messageId = msg?.id ?? null;

        // Prevent duplicates
        if (messageId && seenMessageIds.has(messageId)) return;
        if (messageId) seenMessageIds.add(messageId);
        /* PLAY SOUND for incoming messages */
        if (!initialLoad && msg.from !== "user") {
            playMessageSound();
        }

        const createdAt = msg.created_at ? new Date(msg.created_at) : new Date();
        const dateKey = createdAt.toDateString();

        // Date separator (already present in your code)
        if (dateKey !== lastRenderedDateKey) {
            const sep = document.createElement('div');
            sep.className = 'sc-date-sep';
            sep.innerText = formatDateLabel(createdAt);
            document.getElementById('sc-messages').appendChild(sep);
            lastRenderedDateKey = dateKey;
        }

        // SYSTEM MESSAGE
        if (msg.sender_type === 'system') {
            const div = document.createElement('div');
            div.className = 'sc-system';
            div.innerHTML = `
            <div>${escapeHtml(msg.text || '')}</div>
            <div class="sc-time">${formatTime(createdAt)}</div>
        `;
            document.getElementById('sc-messages').appendChild(div);
            scrollToBottom();
            return;
        }

        // USER / AGENT MESSAGE
        const row = document.createElement('div');
        row.className = `sc-row ${msg.from === 'user' ? 'sc-user-row' : ''}`;

        const avatar = document.createElement('div');
        avatar.className = `sc-avatar ${msg.from}`;
        avatar.innerText =
            msg.from === 'user' ? 'You' :
            msg.from === 'agent' ? (msg.sender_name?.[0] || 'A') :
            'S';

        const bubble = document.createElement('div');
        bubble.className = `sc-msg ${msg.from === 'user' ? 'sc-user' : 'sc-agent'}`;

        const senderName = msg.sender_name;

        bubble.innerHTML = `

        <div>${escapeHtml(msg.text || '').replace(/\n/g, '<br>')}</div>
        <div class="sc-time">${formatTime(createdAt)}</div>
    `;

        row.appendChild(avatar);
        row.appendChild(bubble);

        document.getElementById('sc-messages').appendChild(row);
        scrollToBottom();
    }


    /* -----------------------------
       Scroll helper
    ------------------------------ */
    function scrollToBottom() {
        const box = document.getElementById('sc-messages');
        box.scrollTop = box.scrollHeight;
    }

    /* -----------------------------
       Formatting helpers (NEW)
    ------------------------------ */
    function formatDateLabel(d) {
        const today = new Date();
        const startOfToday = new Date(today.getFullYear(), today.getMonth(), today.getDate());
        const startOfThatDay = new Date(d.getFullYear(), d.getMonth(), d.getDate());
        const diffDays = Math.round((startOfToday - startOfThatDay) / 86400000);

        if (diffDays === 0) return 'Today';
        if (diffDays === 1) return 'Yesterday';

        return d.toLocaleDateString(undefined, {
            month: 'short', 
            day: 'numeric',
            year: 'numeric'
        });
    }

    function formatTime(d) {
        return d.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // basic escape for safety
    function escapeHtml(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }


    /* ============================================================
       CHAT LOGIC
    ============================================================ */

    function startChat() {
        if (!widgetValid) return;

        const name = qs("g-name").value.trim();
        const email = qs("g-email").value.trim();

        apiPost("/start", { name, email }).then(d => {
            conversationUuid = d.uuid;
            localStorage.setItem("ezead_uuid", conversationUuid);

            if (d.agents_online) {
                setTimeout(async () => {
                    await checkAssignment(conversationUuid);
                }, 120000); // 2 minutes
            }

            qs("sc-form").style.display = "none";
            qs("sc-input").style.display = "flex";

            startSSE();
        });
    }

    qs("start-chat").onclick = startChat;

    function sendMessage() {
        const input = qs("chat-text");
        const text = input.value.trim();
        if (!text || !conversationUuid) return;

        input.value = "";

        apiPost("/message", {
            uuid: conversationUuid,
            message: text
        });
    }

    qs("send-msg").onclick = sendMessage;

    qs("chat-text").addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            sendMessage();
        }
    });

    function fetchMessages() {
        if (!conversationUuid) return;

        apiGet("/messages", {
            uuid: conversationUuid,
            after_id: lastMessageId
        }).then(data => {
            if (!data.messages) return;
            data.messages.forEach(addMessage);
            initialLoad = false;
        });
    }

    function resumeChat() {
        apiGet("/resume", { uuid: conversationUuid }).then(data => {
            if (!data.valid) return;

            qs("sc-form").style.display = "none";
            qs("sc-input").style.display = "flex";

            data.messages.forEach(addMessage);
            initialLoad = false;
            
            startSSE();
        });
    }

    async function checkAssignment(uuid) {
        alert("Checking assignment...");
        const res = await fetch('/widget/check-assignment', {
            method: 'POST',
            body: JSON.stringify({ uuid }),
            headers: { 'Content-Type': 'application/json' }
        });

        const data = await res.json();

        if (data.handled_by === 'ai') {
            // switch UI to AI mode
        }
    }

    function startSSE() {
        if (!conversationUuid) return;

        if (eventSource) eventSource.close();

        eventSource = new EventSource(
            apiUrl("/events", {
                uuid: conversationUuid,
                last_id: lastEventId
            })
        );

        eventSource.addEventListener("message", function (e) {
            if (e.lastEventId) {
                lastEventId = Number(e.lastEventId);
                localStorage.setItem("ezead_last_event_id", lastEventId);
            }
            fetchMessages();
        });

        eventSource.onerror = function () {
            if (eventSource) {
                eventSource.close();
                eventSource = null;
            }
            setTimeout(startSSE, 3000);
        };
    }

    /* ============================================================
       INIT
    ============================================================ */
    function validateWidgetKey() {
        return apiGet("/validate")
            .then(res => {
                if (!res.valid) {
                    widgetValid = false;
                    showInvalidWidgetMessage(res.message || "This chat widget is not available.");
                }
                else{
                    const company_name = qs("company_name");
                    company_name.innerHTML= res.site_name+" Live Chat"
                }
            })
            .catch(() => {
                widgetValid = false;
                showInvalidWidgetMessage("This chat widget is not configured correctly.");
            });
    }
    document.addEventListener("DOMContentLoaded", function () {
        validateWidgetKey().then(() => {
            if (widgetValid && conversationUuid) {
                resumeChat();
            }
        });
    });

})();