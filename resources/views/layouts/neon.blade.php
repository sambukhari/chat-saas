<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="icon" type="image/png" sizes="32x32" href="https://eze.pics/ezead-com/public/favicon/favicon-32x32.png"
        title="Powered by Ezead AI">
<title>{{ $title ?? 'EzeAD Workspace' }}</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* =========================================================
   EzeAD Brand Dark Theme (Blue + Orange)
   ========================================================= */
:root{
    --bg0:#050814;              /* deepest */
    --bg1:#070b1c;              /* base */
    --panel:#0b122a;            /* sidebar/panels */
    --card:rgba(12,18,40,.72);  /* card glass */
    --stroke:rgba(255,255,255,.10);

    --blue:#1EA7FF;             /* brand blue */
    --blue2:#2B7CFF;            /* deeper blue */
    --orange:#FF8A1E;           /* brand orange */
    --orange2:#FFB24A;          /* warmer */
    --text:#EAF2FF;
    --muted:rgba(234,242,255,.68);

    --shadow: 0 18px 60px rgba(0,0,0,.45);
    --radius: 18px;
}

/* Base */
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
.logosmall{
    width:110px;
    display: block;
}
.logosmall img{
    width:100%;
}
.btn-neon-outline {
    border: 1px solid #0ea5e9;
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

/* Subtle animated background gradient */
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

/* Floating orbs */
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

/* Spark canvas layer */
#sparkCanvas{
    position:fixed;
    inset:0;
    z-index:1;
    pointer-events:none;
    opacity:.85;
}

/* Layout wrappers */
.app{
    position:relative;
    z-index:2;
}

/* Topbar */
.topbar{
    height:72px;
    position:fixed;
    top:0; left:0; right:0;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 18px;
    background: linear-gradient(180deg, rgba(11,18,42,.78), rgba(11,18,42,.46));
    backdrop-filter: blur(10px);
    border-bottom:1px solid rgba(255,255,255,.08);
    z-index:20;
}

.btn-neon{
    background: linear-gradient(90deg, rgba(0,247,255,.22), rgba(168,85,247,.22));
    border:1px solid rgba(0,247,255,.35);
    color:var(--text);
}
.btn-neon:hover{
    border-color: rgba(168,85,247,.55);
    box-shadow: 0 0 24px rgba(168,85,247,.18);
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
    color: var(--muted);
    margin-top:2px;
}

/* Topbar right */
.role-pill{
    font-size:12px;
    color: var(--text);
    background: rgba(255,255,255,.06);
    border:1px solid rgba(255,255,255,.10);
    padding:6px 10px;
    border-radius:999px;
}
.role-pill b{ color: var(--blue); }

/* Sidebar */
.sidebar{
    width:284px;
    position:fixed;
    top:72px;
    left:0;
    height:calc(100vh - 72px);
    padding:18px 14px;
    background: linear-gradient(180deg, rgba(11,18,42,.82), rgba(11,18,42,.62));
    border-right:1px solid rgba(255,255,255,.08);
    backdrop-filter: blur(10px);
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
    color: rgba(234,242,255,.86);
    border:1px solid transparent;
    transition: transform .18s ease, background .18s ease, border-color .18s ease;
    position:relative;
}
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

/* Logout button */
.btn-logout{
    margin-top:12px;
    width:100%;
    border-radius:14px;
    border:1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.06);
    color: var(--text);
    padding:10px 12px;
    transition: transform .18s ease, border-color .18s ease, background .18s ease;
}
.btn-logout:hover{
    transform: translateY(-1px);
    border-color: rgba(255,138,30,.22);
    background: rgba(255,138,30,.08);
}

/* Main */
.main{
    margin-top:72px;
    margin-left:284px;
    padding:26px;
    min-height:calc(100vh - 72px);
    animation: contentIn .35s ease both;
}
@keyframes contentIn{
    from{ opacity:0; transform: translateY(6px); }
    to{ opacity:1; transform: translateY(0); }
}

/* Cards / Panels */
.card-eze{
    background: var(--card);
    border:1px solid rgba(255,255,255,.10);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    backdrop-filter: blur(10px);
}
.card-eze .card-header{
    background: transparent;
    border-bottom:1px solid rgba(255,255,255,.08);
}

/* Inputs */
.form-control, .form-select, textarea{
    background: rgba(255,255,255,.05) !important;
    border: 1px solid rgba(255,255,255,.12) !important;
    color: var(--text) !important;
    border-radius: 14px !important;
}
.form-control:focus, .form-select:focus, textarea:focus{
    box-shadow: 0 0 0 .2rem rgba(30,167,255,.18) !important;
    border-color: rgba(30,167,255,.28) !important;
}
.form-control::placeholder{ color: rgba(234,242,255,.50); }

/* Buttons */
.btn-brand{
    border:none;
    border-radius:14px;
    padding:10px 14px;
    color:#081025;
    font-weight:700;
    background: linear-gradient(135deg, var(--blue), var(--orange));
    box-shadow: 0 10px 28px rgba(30,167,255,.12);
    transition: transform .18s ease, filter .18s ease;
}
.btn-brand:hover{ transform: translateY(-1px); filter: brightness(1.05); }
.btn-ghost{
    border-radius:14px;
    border:1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.05);
    color: var(--text);
    padding:10px 14px;
    font-weight:600;
}
.btn-ghost:hover{
    border-color: rgba(255,138,30,.22);
    background: rgba(255,138,30,.08);
}

/* Tables */
.table-dark{
    --bs-table-bg: transparent;
    --bs-table-striped-bg: rgba(255,255,255,.03);
    --bs-table-hover-bg: rgba(30,167,255,.05);
    color: rgba(234,242,255,.90);
}
.table thead th{
    color: rgba(234,242,255,.70);
    border-bottom:1px solid rgba(255,255,255,.10) !important;
}
.table td, .table th{
    border-color: rgba(255,255,255,.08) !important;
}

/* Responsive: mobile sidebar slide */
@media (max-width: 992px){
    .sidebar{
        transform: translateX(-110%);
        width: 86%;
        max-width: 320px;
        box-shadow: 0 18px 60px rgba(0,0,0,.55);
        border-right:1px solid rgba(255,255,255,.10);
    }
    .sidebar.show{
        transform: translateX(0);
    }
    .main{
        margin-left:0;
        padding:18px;
    }
}

/* Guest mode (no sidebar/topbar) */
.guest-wrap{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
}
.guest-card{
    width:100%;
    max-width: 460px;
    padding: 22px;
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
</style>
@stack('after_styles_stack')

@stack('head')
</head>

<body>

<div class="bg-anim"></div>
<div class="orb blue"></div>
<div class="orb orange"></div>
<canvas id="sparkCanvas"></canvas>

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

    {{-- TOPBAR --}}
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

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="sidebar">
        <div class="section-title">Navigation</div>

        {{-- ADMIN --}}
        @if(Auth::guard('admin')->check())
            <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
                <span class="nav-dot"></span> Dashboard
            </a>

            <a class="nav-item" href="{{ route('admin.companies.index') }}" >
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

        {{-- COMPANY --}}
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

        {{-- AGENT --}}
        @if(Auth::guard('agent')->check())
            <a class="nav-item {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}"
               href="{{ route('agent.dashboard') }}">
                <span class="nav-dot"></span> Dashboard
            </a>

            <a class="nav-item {{ request()->routeIs('agent.chats.*') ? 'active' : '' }}"
               href="{{ route('agent.chats.index') }}">
                <span class="nav-dot"></span> My Chats
            </a>

            <form method="POST" action="{{ route('agent.logout') }}">
                @csrf
                <button class="btn-logout" type="submit">Logout</button>
            </form>
        @endif
    </aside>

    {{-- MAIN --}}
    <main class="main">
        @yield('content')
    </main>

</div>

@else

{{-- GUEST (LOGIN) --}}
<div class="guest-wrap">
    <div class="card-eze guest-card">
        <div class="guest-head">
            <div>
               <a class="logosmall" href="/" aria-label="Ezead Home">
              <img src="https://eze.pics/ezead-chat-images/logo2.png" alt="Ezead Logo" />
            </a>
                <div class="small-muted">Secure access portal</div>
            </div>
        </div>

        @yield('content')
    </div>
</div>

@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* =========================================================
   Sidebar toggle (mobile)
   ========================================================= */
function toggleSidebar(){
    const sb = document.getElementById('sidebar');
    if (!sb) return;
    sb.classList.toggle('show');
}

/* =========================================================
   Spark / Particle Canvas (lightweight, efficient)
   ========================================================= */
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

    // particles
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

        // dots
        for(const p of parts){
            p.x += p.vx;
            p.y += p.vy;

            // wrap
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

        // connecting spark lines (only a few nearest, cheap)
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
</script>

@stack('scripts')
@stack('after_scripts_stack')

</body>
</html>