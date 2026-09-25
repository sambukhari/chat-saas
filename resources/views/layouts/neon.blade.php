<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" sizes="32x32" href="https://eze.pics/ezead-com/public/favicon/favicon-32x32.png" title="Powered by Ezead AI">
<title>{{ $title ?? 'EzeAD Workspace' }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
:root{
    --bg0:#050814;
    --bg1:#070b1c;
    --panel:#0b122a;
    --card:rgba(12,18,40,.72);
    --stroke:rgba(255,255,255,.10);
    --blue:#1EA7FF;
    --blue2:#2B7CFF;
    --orange:#FF8A1E;
    --orange2:#FFB24A;
    --text:#EAF2FF;
    --muted:rgba(234,242,255,.68);
    --shadow: 0 18px 60px rgba(0,0,0,.45);
    --radius: 18px;
}

html,body{height:100%;}
body{
    margin:0;
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
    color: var(--text);
    background: radial-gradient(1200px 700px at 20% 10%, rgba(30,167,255,.14), transparent 55%),
                radial-gradient(1000px 650px at 90% 15%, rgba(255,138,30,.13), transparent 55%),
                linear-gradient(180deg, var(--bg0), var(--bg1));
    overflow-x:hidden;
}
a{ text-decoration:none; }

.logosmall{
    width:150px;
    display:block;
    padding:10px;
    background:#fff;
    border-radius:50px;
}
.logosmall img{ width:100%; }

.btn-neon-outline {
    color: #0ea5e9;
    background: transparent;
    border-radius: 25px;
    padding: 6px 16px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.btn-neon-outline:hover {
    background: linear-gradient(135deg,#0ea5e9,#2563eb);
    color: #fff;
    box-shadow: 0 0 12px rgba(14,165,233,.6);
}

.bg-anim{
    position:fixed;
    inset:-40%;
    background: radial-gradient(900px 500px at 30% 20%, rgba(30,167,255,.18), transparent 55%),
                radial-gradient(700px 450px at 70% 30%, rgba(255,138,30,.16), transparent 60%),
                radial-gradient(900px 600px at 50% 75%, rgba(43,124,255,.10), transparent 65%);
    filter: blur(28px);
    animation: drift 14s ease-in-out infinite alternate;
    pointer-events:none;
    z-index:0;
}
@keyframes drift{
    0%{ transform: translate3d(-2%, -1%, 0) scale(1.02); opacity:.70; }
    100%{ transform: translate3d(2%, 1.5%, 0) scale(1.05); opacity:.95; }
}

.orb{
    position:fixed;
    border-radius:999px;
    filter: blur(26px);
    opacity:.65;
    pointer-events:none;
    z-index:0;
}
.orb.blue{
    width:420px; height:420px;
    left:-110px; top:120px;
    background: radial-gradient(circle at 30% 30%, rgba(30,167,255,.55), transparent 65%);
    animation: float1 10s ease-in-out infinite alternate;
}
.orb.orange{
    width:460px; height:460px;
    right:-150px; top:180px;
    background: radial-gradient(circle at 30% 30%, rgba(255,138,30,.50), transparent 65%);
    animation: float2 12s ease-in-out infinite alternate;
}
@keyframes float1{
    0%{ transform: translateY(0) translateX(0); }
    100%{ transform: translateY(-26px) translateX(16px); }
}
@keyframes float2{
    0%{ transform: translateY(0) translateX(0); }
    100%{ transform: translateY(22px) translateX(-18px); }
}

#sparkCanvas{
    position:fixed;
    inset:0;
    z-index:1;
    pointer-events:none;
    opacity:.85;
}

.nav-submenu{ padding-left:20px; }
.nav-subitem{
    display:block;
    padding:6px 10px;
    font-size:14px;
}
.nav-subitem.active{ font-weight:bold; }

.nav-submenu{
    display:flex;
    flex-direction:column;
    gap:5px;
    padding-left:20px;
}
.nav-submenu.show{ display:block; }

.nav-subitem{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:6px 10px;
    font-size:14px;
}
.nav-subitem .chat-counter {
    width: 20px;
    height: 20px;
    font-size: 12px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    background: hsl(45, 100%, 51%);
}
.dropdown-toggle{ cursor:pointer; }

.app{ position:relative; z-index:2; }

.topbar{
    position:fixed;
    top:0; left:0; right:0;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:10px 18px;
    background:#0074A3;
    z-index:20;
}

.btn-neon{
    background:#0074A3;
    color:var(--text);
}
.btn-neon:hover{
    border-color: rgba(168,85,247,.55);
    background:transparent;
    color:#000;
}

.brand{
    display:flex;
    align-items:center;
    gap:10px;
    user-select:none;
}
.brand .mark{
    width:40px; height:40px;
    border-radius:14px;
    background: linear-gradient(135deg, rgba(30,167,255,.22), rgba(255,138,30,.18));
    border:1px solid rgba(255,255,255,.12);
    box-shadow: 0 0 0 1px rgba(30,167,255,.14), 0 0 26px rgba(30,167,255,.10);
    display:grid;
    place-items:center;
    overflow:hidden;
}
.brand .mark::after{
    content:"";
    width:70px; height:70px;
    border-radius:999px;
    background: radial-gradient(circle at 40% 30%, rgba(255,138,30,.55), transparent 60%);
    filter: blur(8px);
    animation: markPulse 3.5s ease-in-out infinite;
}
@keyframes markPulse{
    0%{ transform: translate(-8px,-10px) scale(.96); opacity:.55; }
    100%{ transform: translate(10px,8px) scale(1.08); opacity:.85; }
}
.brand .name{
    font-weight:700;
    letter-spacing:.3px;
    font-size:18px;
    line-height:1;
}
.brand .name .eze{ color: var(--blue); text-shadow: 0 0 22px rgba(30,167,255,.18); }
.brand .name .ad{ color: var(--orange); text-shadow: 0 0 22px rgba(255,138,30,.16); }
.brand .tag{
    display:block;
    font-size:12px;
    color:#fff;
    margin-top:2px;
}

.role-pill{
    font-size: 12px;
    color: #000;
    background: #fff;
    border: 1px solid rgba(255, 255, 255, .10);
    padding: 6px 10px;
    border-radius: 999px;
}
.role-pill b{ color: var(--blue); }

.sidebar{
    width:284px;
    position:fixed;
    top:72px;
    left:0;
    height:calc(100vh - 72px);
    padding:18px 14px;
    background:#fff;
    border-right:1px solid #272343;
    z-index:15;
    transition: transform .28s ease;
}
.sidebar .section-title{
    font-size:11px;
    letter-spacing:.14em;
    color: rgba(234,242,255,.56);
    text-transform: uppercase;
    margin:14px 10px 8px;
}
.nav-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:11px 12px;
    border-radius:14px;
    color:#272343;
    border:1px solid transparent;
    transition: transform .18s ease, background .18s ease, border-color .18s ease;
    position:relative;
}
.nav-subitem{ text-transform: uppercase; }
.nav-item:hover{
    background: rgba(30,167,255,.08);
    border-color: rgba(30,167,255,.14);
    transform: translateY(-1px);
}
.nav-item.active{
    background: linear-gradient(90deg, rgba(30,167,255,.15), rgba(255,138,30,.10));
    border-color: rgba(255,255,255,.12);
    box-shadow: 0 0 0 1px rgba(30,167,255,.10), 0 0 30px rgba(30,167,255,.10);
}
.nav-item.active::before{
    content:"";
    position:absolute;
    left:-6px;
    top:10px;
    bottom:10px;
    width:4px;
    border-radius:999px;
    background: linear-gradient(180deg, var(--blue), var(--orange));
}
.nav-dot{
    width:10px; height:10px;
    border-radius:999px;
    background: rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.12);
    box-shadow: 0 0 18px rgba(30,167,255,.12);
}
.nav-item.active .nav-dot{
    background: linear-gradient(135deg, var(--blue), var(--orange));
    box-shadow: 0 0 22px rgba(255,138,30,.18), 0 0 22px rgba(30,167,255,.14);
}

.btn-logout{
    margin-top:12px;
    width:100%;
    border-radius:14px;
    border:1px solid #666;
    background: rgba(255,255,255,.06);
    color:#000;
    padding:10px 12px;
    transition: transform .18s ease, border-color .18s ease, background .18s ease;
}
.btn-logout:hover{
    transform: translateY(-1px);
    border-color: rgba(255,138,30,.22);
    background: rgba(255,138,30,.08);
}

.main{
    margin-top:72px;
    margin-left:284px;
    padding:26px;
    min-height:100svh;
    animation: contentIn .35s ease both;
    background:#f9f9f9;
}
.main h4,
.main .display-6,
.main .text-muted-neon,
.main .neon-title{
    color:#000;
}
@keyframes contentIn{
    from{ opacity:0; transform: translateY(6px); }
    to{ opacity:1; transform: translateY(0); }
}

.card-eze{
    background: transparent;
    border:1px solid rgba(255,255,255,.10);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
}
.card-eze .card-header{
    background: transparent;
    border-bottom:1px solid rgba(255,255,255,.08);
}

.form-control, .form-select, textarea{
    background: rgba(255,255,255,.05) !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    color: #000 !important;
    border-radius: 14px !important;
}
.form-control:focus, .form-select:focus, textarea:focus{
    box-shadow: 0 0 0 .2rem rgba(30,167,255,.18) !important;
    border-color: rgba(30,167,255,.28) !important;
}
.form-control::placeholder{ color: rgba(234,242,255,.50); }

.btn-brand{
    border:none;
    border-radius:14px;
    padding:10px 14px;
    color:#fff;
    font-weight:700;
    border:1px solid #0074A3;
    background:#0074A3;
    box-shadow: 0 10px 28px rgba(30,167,255,.12);
    transition: transform .18s ease, filter .18s ease;
}
.btn-brand:hover{
    border-color:#0074a3;
    color:#272343;
    background: transparent;
}
.btn-ghost{
    border-radius:5px;
    border:1px solid rgba(255,255,255,.12);
    background:#0074a3;
    color: var(--text);
    padding:4px 8px;
    font-weight:600;
    position: relative;
    top: 4px;
}
.btn-ghost:hover{ border-color: rgba(255,138,30,.22); }

.table-dark{
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(255,255,255,.03);
    --bs-table-hover-bg: rgba(30,167,255,.05);
    color: rgba(234,242,255,.90);
}
.table thead th{
    color:#000;
    border-bottom:1px solid #000 !important;
}
.table td, .table th{
    color:#000 !important;
    border-color: rgba(255,255,255,.08) !important;
}

@media (max-width: 992px){
    .sidebar{
        transform: translateX(-110%);
        width: 86%;
        max-width: 320px;
        box-shadow: 0 18px 60px rgba(0,0,0,.55);
        border-right:1px solid rgba(255,255,255,.10);
    }
    .sidebar.show{ transform: translateX(0); }
    .main{
        margin-left:0;
        padding:18px;
    }
}

.guest-wrap{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
}
.guest-head{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:14px;
}
.guest-head .logo-dot{
    width:44px;height:44px;border-radius:16px;
    background: linear-gradient(135deg, rgba(30,167,255,.22), rgba(255,138,30,.18));
    border:1px solid rgba(255,255,255,.12);
    box-shadow: 0 0 0 1px rgba(30,167,255,.10), 0 0 30px rgba(30,167,255,.12);
}
.small-muted{ color: var(--muted); }

@media screen and (max-width:767px){
    .guest-wrap{ padding:0px; }
    .guest-head {
        display: flex;
        margin: auto;
        justify-content: center;
    }
}

.text-muted { color: rgb(177 182 186 / 75%) !important; }

.send_msg_wrap {
    display:flex;
    align-items:center;
    justify-content:space-between;
    overflow:hidden;
    border:1px solid #0074a3;
    border-radius:50px;
}
.send_msg_wrap input:focus{
    color:#666 !important;
    box-shadow:none !important;
    border:0 !important;
    outline:0;
}
.send_msg_wrap input::placeholder{ color:#666 !important; }
.send_msg_wrap .btn-neon { border-radius:50%; }
.btn-outline-light{
border-color: rgba(168, 85, 247, .55);
background: transparent;
color: #000;
}
.btn-outline-light:hover{
    background:#0074a3;
    color:#fff;
}
body {
    background:#f9f9f9;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}
.eze_logo{
    display:flex;
    align-items:start;
    justify-content:start;
    width:224px;
    height:63px;
}
.eze_logo img {
    width:80%;
    height:auto;
    display:block;
    aspect-ratio: 224 / 63;
}

.admin_login *{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
.admin_login{
    display:flex;
    align-items:center;
    justify-content:center;
    height:100svh;
}
.admin_login .login{
    width:450px;
    background:#fff;
    padding:40px 35px;
    border-radius:10px;
    box-shadow:0 10px 35px rgba(0,0,0,0.08);
    margin:auto;
}
.admin_login .form_title{
    text-align:center;
    margin-bottom:30px;
}
.admin_login .form_title h2{
    font-family:'DM Serif Display', serif;
    font-size:28px;
    line-height:32px;
    font-weight:700;
    color:#1a1a1a;
}
.admin_login .form_title span{
    font-size:14px;
    color:#666;
}
.admin_login form{
    display:flex;
    flex-direction:column;
    gap:12px;
}
.admin_login .field{
    display:flex;
    flex-direction:column;
    gap:5px;
}
.admin_login .field label{
    font-size:14px;
    font-weight:500;
    color:#333;
    display:block;
    margin-bottom:6px;
}
.admin_login .input-wrap{ position:relative; }
.admin_login .input-wrap input{
    width:100%;
    height:45px;
    border:1px solid #ddd;
    border-radius:6px;
    padding:0 40px;
    font-size:14px;
    outline:none;
    transition:0.3s;
}
.admin_login .input-wrap input:focus{ border-color:#0074A3; }
.admin_login .icon{
    position:absolute;
    left:12px;
    top:50%;
    transform:translateY(-50%);
    color:#888;
}
.admin_login .toggle-pw{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    border:none;
    background:none;
    cursor:pointer;
    color:#777;
    font-size:15px;
}
.admin_login .btn-login{
    width:100%;
    height:45px;
    border:none;
    border-radius:6px;
    background:#f38521;
    color:#fff;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    margin-top:5px;
    transition:0.3s;
}
.admin_login .btn-login:hover{ background:#da741c; }
.admin_login .meta-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:12px;
    font-size:13px;
}
.admin_login .remember{
    display:flex;
    align-items:center;
    gap:6px;
    color:#555;
}
.admin_login #remember{ position:relative; top:2px; }
.admin_login .forgot{
    text-decoration:none;
    color:#0074A3;
}
.admin_login .switch-portal{
    margin-top:30px;
    text-align:center;
}
.admin_login .switch-portal p{
    font-size:14px;
    color:#666;
    margin-bottom:10px;
}
.admin_login .portal-btns{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
}
.admin_login .btn-portal{
    border-radius:6px;
    border:1px solid #0074A3;
    background:#00A9DA29;
    color:#0074A3;
    font-size:16px;
    line-height:22px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
    text-decoration:none;
    text-align:center;
    padding:10px 25px;
}
.admin_login .btn-portal:hover{
    background:#0074A3;
    color:#fff;
}

@media screen and (max-width:991px){
    .eze_logo { margin-bottom:20px !important; }
}
@media screen and (max-width:767px){
    .admin_login {
        width:100%;
        height:95svh;
    }
    .eze_logo {
        width:180px;
        height:30px;
        margin:auto;
        align-items:center;
        justify-content:center;
    }
    .admin_login .form_title { margin-bottom:15px; }
    .admin_login .login {
        width:95%;
        padding:20px 20px;
    }
    .admin_login .switch-portal { margin-top:15px; }
    .admin_login .form_title h2{
        font-size:20px;
        line-height:26px;
    }
    .admin_login #remember { top:0px; }
    .admin_login .btn-portal {
        font-size:14px;
        line-height:20px;
        padding:10px 20px;
    }
}
.text-muted{ color:#666 !important; }
.chat-header{ color:#666; }

.nav-submenu {
    position: relative;
}
.site-pagination {
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:8px;
    border-top:1px solid rgba(0,0,0,0.1);
    background: rgba(0,0,0,0.02);
}
.site-pagination .sp-btn {
    background:gray;
    border:none;
    color:#fff;
    width:30px;
    height:30px;
    border-radius:50%;
    font-size:12px;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition: all 0.25s;
}
.site-pagination .sp-btn:hover:not(:disabled) {
    background:#0074a3;
    color:#fff;
}
.site-pagination .sp-btn:disabled {
    opacity:0.3;
    cursor:not-allowed;
}
.site-pagination .sp-info {
    font-size:11px;
    color:#666;
    min-width:50px;
    text-align:center;
}
</style>
<style>
.badge.badge-soft{
    color:#272343;
}
.company_form .form_label{
    color:#272343;
    margin-bottom:10px;
}
    .company_form .form_select,
    .company_form .comp_email,
    .company_form .comp_passw,
    .company_form .comp_name{
        width: 100%;
        font-size: 14px;
        line-height: 22px;
        padding: 8px;
        border-radius: 40px;
        border: 1px solid #666;
    }
    .company_form .form_select:focus,
    .company_form .comp_email:focus,
    .company_form .comp_passw:focus,
    .company_form .comp_name:focus{
    border-color: #0074a3;
    outline: none;
}

</style>
@stack('after_styles_stack')
@stack('head')
</head>
<body>

@php
    $isLoggedIn =
        Auth::guard('admin')->check() ||
        Auth::guard('company')->check() ||
        Auth::guard('agent')->check();

    $roleLabel = 'Guest';
    if (Auth::guard('admin')->check()) $roleLabel = 'Admin';
    elseif (Auth::guard('company')->check()) $roleLabel = 'Company';
    elseif (Auth::guard('agent')->check()) $roleLabel = 'Agent';
@endphp

@if($isLoggedIn)
<div class="app">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-ghost d-lg-none py-2 px-3" type="button" onclick="toggleSidebar()">
                ☰
            </button>
            <div class="brand">
                <div>
                    <a class="logosmall" href="/" aria-label="Ezead Home">
                        <img src="https://eze.pics/ezead-chat-images/logo2.png" alt="Ezead Logo" />
                    </a>
                    <span class="tag">Workspace Dashboard</span>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="role-pill">
                Logged in as <b>{{ $roleLabel }}</b>
            </div>
        </div>
    </div>

    <aside id="sidebar" class="sidebar">
        <div class="section-title text-dark">Navigation</div>

        @if(Auth::guard('admin')->check())
            <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
                <span class="nav-dot"></span> Dashboard
            </a>

            <a class="nav-item" href="{{ route('admin.companies.index') }}">
                <span class="nav-dot"></span> Companies
            </a>

            <a class="nav-item" href="#" onclick="return false;">
                <span class="nav-dot"></span> Plans (next)
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        @endif

        @if(Auth::guard('company')->check())
            <a class="nav-item {{ request()->routeIs('company.dashboard') ? 'active' : '' }}"
               href="{{ route('company.dashboard') }}">
                <span class="nav-dot"></span> Dashboard
            </a>

            <a class="nav-item {{ request()->routeIs('company.sites.*') ? 'active' : '' }}"
               href="{{ route('company.sites.index') }}">
                <span class="nav-dot"></span> Sites
            </a>

            <a class="nav-item {{ request()->routeIs('company.agents.*') ? 'active' : '' }}"
               href="{{ route('company.agents.index') }}">
                <span class="nav-dot"></span> Agents
            </a>

            <a class="nav-item {{ request()->routeIs('company.chats.*') ? 'active' : '' }}"
               href="{{ route('company.chats.index') }}">
                <span class="nav-dot"></span> Chats
            </a>

            <form method="POST" action="{{ route('company.logout') }}">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        @endif

        @if(Auth::guard('agent')->check())
            @php
                $agent = Auth::guard('agent')->user();
                $sites = $agent->company->sites;

                $currentConversationId = isset($conversation) ? $conversation->id : null;
                $currentSiteId = isset($conversation) ? $conversation->site_id : request()->get('site');
            @endphp

            <a class="nav-item {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}"
               href="{{ route('agent.dashboard') }}">
                <span class="nav-dot"></span> Dashboard
            </a>

            <div class="nav-item dropdown-toggle" onclick="toggleChatsMenu()">
                <span class="nav-dot"></span> All Chats
            </div>

            <div id="chatsDropdown" class="nav-submenu">
                <div id="sites-list">
                    @foreach($sites as $site)
                        @php
                            $siteUnread = method_exists($site, 'getUnreadCountForAgentAttribute')
                                ? $site->unread_count_for_agent
                                : ($site->unread_count ?? 0);

                            if (!empty($conversation) && (int)$conversation->site_id === (int)$site->id) {
                                $siteUnread = max(0, (int)$siteUnread - (int)($conversation->unread_count ?? 0));
                            }
                        @endphp

                        <a class="nav-subitem nav-item {{ request()->get('site') == $site->id ? 'active' : '' }}"
                           href="{{ route('agent.chats.index',['site'=>$site->id]) }}"
                           data-site-id="{{ $site->id }}">
                            {{ $site->domain }}
                            <span class="chat-counter"
                                  id="counter-site-{{ $site->id }}"
                                  data-site-id="{{ $site->id }}">
                                {{ $siteUnread }}
                            </span>
                        </a>
                    @endforeach
                </div>

                <div class="site-pagination" id="site-pagination" style="display:none;">
                    <button class="sp-btn" id="site-prev"><i class="fa fa-chevron-left"></i></button>
                    <span class="sp-info" id="site-info">1 / 1</span>
                    <button class="sp-btn" id="site-next"><i class="fa fa-chevron-right"></i></button>
                </div>
            </div>

            <form method="POST" action="{{ route('agent.logout') }}">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        @endif
    </aside>

    <main class="main">
        @yield('content')
    </main>
</div>
@else
<div class="guest-wrap">
    @yield('content')
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
var _sitePage = 1;
var PER_SITE = 7;

function applySitePagination() {
    var list = document.getElementById('sites-list');
    var paginationEl = document.getElementById('site-pagination');
    var prevBtn = document.getElementById('site-prev');
    var nextBtn = document.getElementById('site-next');
    var infoEl = document.getElementById('site-info');

    if (!list) return;

    var items = Array.from(list.querySelectorAll('.nav-subitem'));
    var total = items.length;
    var totalPages = Math.max(1, Math.ceil(total / PER_SITE));

    _sitePage = Math.min(_sitePage, totalPages);
    var start = (_sitePage - 1) * PER_SITE;

    items.forEach(function(item, i) {
        item.style.display = (i >= start && i < start + PER_SITE) ? '' : 'none';
    });

    if (paginationEl) paginationEl.style.display = totalPages > 1 ? 'flex' : 'none';
    if (infoEl) infoEl.textContent = _sitePage + ' / ' + totalPages;
    if (prevBtn) prevBtn.disabled = _sitePage === 1;
    if (nextBtn) nextBtn.disabled = _sitePage === totalPages;
}

document.addEventListener('DOMContentLoaded', function() {
    var prevBtn = document.getElementById('site-prev');
    var nextBtn = document.getElementById('site-next');

    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (_sitePage > 1) {
                _sitePage--;
                applySitePagination();
            }
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (_sitePage < 9999) {
                _sitePage++;
                applySitePagination();
            }
        });
    }

    applySitePagination();
});
</script>

<script>
function toggleSidebar(){
    const sb = document.getElementById('sidebar');
    if (!sb) return;
    sb.classList.toggle('show');
}

(function(){
    const canvas = document.getElementById('sparkCanvas');
    if(!canvas) return;

    const ctx = canvas.getContext('2d', { alpha: true });
    let w, h, dpr;

    function resize(){
        dpr = Math.min(window.devicePixelRatio || 1, 2);
        w = canvas.width = Math.floor(window.innerWidth * dpr);
        h = canvas.height = Math.floor(window.innerHeight * dpr);
        canvas.style.width = window.innerWidth + 'px';
        canvas.style.height = window.innerHeight + 'px';
        ctx.setTransform(dpr,0,0,dpr,0,0);
    }
    window.addEventListener('resize', resize, { passive:true });
    resize();

    const count = Math.min(90, Math.floor((window.innerWidth * window.innerHeight) / 24000));
    const parts = [];
    const colors = [
        'rgba(30,167,255,0.55)',
        'rgba(43,124,255,0.45)',
        'rgba(255,138,30,0.50)',
        'rgba(255,178,74,0.38)'
    ];

    function rnd(min,max){ return Math.random()*(max-min)+min; }

    for(let i=0;i<count;i++){
        parts.push({
            x:rnd(0, window.innerWidth),
            y:rnd(0, window.innerHeight),
            r:rnd(0.8, 2.2),
            vx:rnd(-0.18, 0.18),
            vy:rnd(-0.12, 0.16),
            c:colors[(Math.random()*colors.length)|0],
            a:rnd(0.25, 0.85)
        });
    }

    function step(){
        ctx.clearRect(0,0,window.innerWidth,window.innerHeight);

        for(const p of parts){
            p.x += p.vx;
            p.y += p.vy;

            if(p.x < -10) p.x = window.innerWidth + 10;
            if(p.x > window.innerWidth + 10) p.x = -10;
            if(p.y < -10) p.y = window.innerHeight + 10;
            if(p.y > window.innerHeight + 10) p.y = -10;

            ctx.globalAlpha = p.a;
            ctx.beginPath();
            ctx.fillStyle = p.c;
            ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
            ctx.fill();
        }

        ctx.globalAlpha = 0.22;
        for(let i=0;i<parts.length;i++){
            const a = parts[i];
            for(let j=i+1;j<parts.length;j++){
                const b = parts[j];
                const dx = a.x - b.x;
                const dy = a.y - b.y;
                const dist = dx*dx + dy*dy;
                if(dist < 120*120){
                    const alpha = 1 - (dist / (120*120));
                    ctx.globalAlpha = alpha * 0.18;
                    ctx.strokeStyle = (i % 2 === 0) ? 'rgba(30,167,255,0.45)' : 'rgba(255,138,30,0.40)';
                    ctx.lineWidth = 1;
                    ctx.beginPath();
                    ctx.moveTo(a.x, a.y);
                    ctx.lineTo(b.x, b.y);
                    ctx.stroke();
                }
            }
        }

        requestAnimationFrame(step);
    }
    step();
})();

function toggleChatsMenu() {
    let menu = document.getElementById('chatsDropdown');
    if (menu) menu.classList.toggle('show');
}
</script>

@if(Auth::guard('agent')->check())
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.__agentGlobalSSEInitialized) return;
    window.__agentGlobalSSEInitialized = true;

    let agentLastEventId = Number(localStorage.getItem('agent_last_event_id') || 0);
    let eventSource = null;

    const currentConversationId = Number(document.body.dataset.currentConversationId || 0);
    const currentSiteId = Number(document.body.dataset.currentSiteId || 0);

    const sound = new Audio('/sounds/new-message.mp3');
    sound.preload = 'auto';

    function setSiteCounter(siteId, value) {
        const el = document.getElementById('counter-site-' + siteId);
        if (!el) return;
        el.innerText = Math.max(0, Number(value || 0));
    }

    function getSiteCounter(siteId) {
        const el = document.getElementById('counter-site-' + siteId);
        if (!el) return 0;
        return Number(el.innerText || 0);
    }

    function incrementSiteCounter(siteId, amount) {
        amount = Number(amount || 1);
        const current = getSiteCounter(siteId);
        setSiteCounter(siteId, current + amount);
    }

    function refreshAgentChatListPage() {
        const table = document.querySelector('#chat-table');
        if (!table) return;

        fetch(window.location.href, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const newTable = doc.querySelector('#chat-table tbody');
            const newGlobal = doc.querySelector('#global-unread');

            if (newTable) {
                const currentTbody = document.querySelector('#chat-table tbody');
                if (currentTbody) currentTbody.innerHTML = newTable.innerHTML;
            }

            if (newGlobal) {
                const currentGlobal = document.querySelector('#global-unread');
                if (currentGlobal) currentGlobal.innerText = newGlobal.innerText;
            }

            if (typeof applyTablePagination === 'function') {
                applyTablePagination();
            }
        });
    }

    function startGlobalAgentSSE() {
        if (eventSource) {
            eventSource.close();
            eventSource = null;
        }

        eventSource = new EventSource('/agent/events?last_id=' + agentLastEventId);

        eventSource.addEventListener('company_message', function (e) {
            if (e.lastEventId) {
                agentLastEventId = Number(e.lastEventId);
                localStorage.setItem('agent_last_event_id', agentLastEventId);
            }

            let payload = {};
            try {
                payload = JSON.parse(e.data || '{}');
            } catch (err) {
                payload = {};
            }

            const eventConversationId = Number(payload.conversation_id || 0);
            const eventSiteId = Number(payload.site_id || 0);

            const isChatShowPage = !!document.getElementById('chat-box');
            const isSameOpenConversation = isChatShowPage && currentConversationId > 0 && eventConversationId === currentConversationId;

            if (eventSiteId > 0 && !isSameOpenConversation) {
                incrementSiteCounter(eventSiteId, 1);
            }

            if (!isSameOpenConversation) {
                sound.currentTime = 0;
                sound.play().catch(function(){});
            }

            if (document.querySelector('#chat-table')) {
                refreshAgentChatListPage();
            }
            window.dispatchEvent(new CustomEvent('agent-company-message', {
                detail: payload
            }));
        });

        eventSource.onerror = function () {
            if (eventSource) {
                eventSource.close();
                eventSource = null;
            }
            setTimeout(startGlobalAgentSSE, 3000);
        };
    }

    startGlobalAgentSSE();
});
</script>
@endif

@stack('scripts')
@stack('after_scripts_stack')
</body>
</html>