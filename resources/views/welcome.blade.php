<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
   <link rel="icon" type="image/png" sizes="32x32" href="https://eze.pics/ezead-com/public/favicon/favicon-32x32.png"
        title="Powered by Ezead AI">
  <title>EzeAD Support AI – SaaS AI Chat & Customer Support Platform</title>
  <meta name="description" content="AI-powered SaaS support chat with live agents, smart automation, analytics and real-time customer engagement tools for businesses and marketplaces." />
  <style>
    :root{
      --bg0:#05060b;
      --bg1:#070a14;
      --card:rgba(255,255,255,.06);
      --card2:rgba(255,255,255,.085);
      --stroke:rgba(255,255,255,.10);
      --stroke2:rgba(255,255,255,.16);
      --txt:rgba(255,255,255,.92);
      --muted:rgba(255,255,255,.64);

      /* “neon like” */
      --c:#18f7ff;   /* cyan */
      --p:#a855ff;   /* purple */
      --g:#2bff88;   /* green accent */
      --danger:#ff3d71;
      --radius:18px;

      --shadow: 0 18px 50px rgba(0,0,0,.45);
      --glowC: 0 0 22px rgba(24,247,255,.45), 0 0 60px rgba(24,247,255,.22);
      --glowP: 0 0 22px rgba(168,85,255,.45), 0 0 60px rgba(168,85,255,.22);
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji";
      color:var(--txt);
      background:
        radial-gradient(1200px 600px at 20% 10%, rgba(24,247,255,.12), transparent 60%),
        radial-gradient(900px 500px at 85% 20%, rgba(168,85,255,.10), transparent 62%),
        radial-gradient(1200px 700px at 60% 90%, rgba(43,255,136,.08), transparent 55%),
        linear-gradient(180deg, var(--bg0), var(--bg1) 40%, var(--bg0));
      overflow-x:hidden;
    }

    /* subtle grid */
    body::before{
      content:"";
      position:fixed; inset:0;
      background-image:
        linear-gradient(to right, rgba(255,255,255,.04) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,.04) 1px, transparent 1px);
      background-size: 42px 42px;
      opacity:.18;
      pointer-events:none;
      mask-image: radial-gradient(circle at 50% 20%, black 0, black 45%, transparent 75%);
      z-index:0;
    }

    /* animated glow blobs */
    .blob{
      position:fixed;
      width:520px; height:520px;
      border-radius:50%;
      filter: blur(42px);
      opacity:.18;
      z-index:0;
      pointer-events:none;
      transform: translateZ(0);
      animation: float 12s ease-in-out infinite;
    }
    .blob.c{background: radial-gradient(circle at 30% 30%, rgba(24,247,255,.9), transparent 60%); left:-180px; top:-200px;}
    .blob.p{background: radial-gradient(circle at 35% 35%, rgba(168,85,255,.9), transparent 62%); right:-220px; top:-180px; animation-delay:-3s;}
    .blob.g{background: radial-gradient(circle at 35% 35%, rgba(43,255,136,.9), transparent 62%); left:35%; bottom:-340px; animation-delay:-6s;}
    @keyframes float{
      0%,100%{ transform: translate(0,0) scale(1);}
      50%{ transform: translate(18px, -18px) scale(1.06);}
    }

    /* particles canvas */
    #fx{
      position:fixed; inset:0;
      z-index:0;
      pointer-events:none;
      opacity:.8;
    }

    a{color:inherit}
    .wrap{position:relative; z-index:1}
    .container{
      max-width:1180px;
      margin:0 auto;
      padding: 0 18px;
    }

    /* Topbar */
    .topbar{
      position:sticky;
      top:0;
      z-index:5;
      backdrop-filter: blur(14px);
      background: rgba(5,6,11,.45);
      border-bottom:1px solid rgba(255,255,255,.08);
    }
    .nav{
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:14px 0;
      gap:14px;
    }
    .brand{
      display:flex; align-items:center; gap:10px;
      min-width: 240px;
    }
    /*.logo{*/
    /*  width:40px; height:40px; border-radius:12px;*/
    /*  background: rgba(255,255,255,.08);*/
    /*  border:1px solid rgba(255,255,255,.10);*/
    /*  display:grid; place-items:center;*/
    /*  overflow:hidden;*/
    /*  box-shadow: var(--shadow);*/
    /*}*/
    .logo{
        width:160px;
    }
    .logo img{
      width:100%;
      height:100%;
      object-fit:contain;
      /*padding:6px;*/
      filter: drop-shadow(0 0 14px rgba(24,247,255,.35));
    }
    .brand h1{
      font-size:14px;
      margin:0;
      letter-spacing:.22em;
      color:rgba(255,255,255,.88);
      text-transform:uppercase;
    }
    .brand .tag{
      font-size:12px; color:var(--muted);
      margin-top:2px;
      letter-spacing:.06em;
    }
    .navlinks{
      display:flex; align-items:center; gap:10px; flex-wrap:wrap;
      justify-content:flex-end;
    }
    .chip{
      padding:10px 12px;
      border-radius:999px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.04);
      color:rgba(255,255,255,.86);
      text-decoration:none;
      display:inline-flex;
      align-items:center;
      gap:10px;
      transition: .18s ease;
      user-select:none;
    }
    .chip:hover{transform: translateY(-1px); border-color: rgba(24,247,255,.35); box-shadow: var(--glowC);}
    .chip.primary{
      background: linear-gradient(90deg, rgb(243 132 31), rgb(22 164 216));
      color:#001012;
      border: none;
      box-shadow: 0 10px 30px rgba(0,0,0,.35), var(--glowP);
      font-weight:700;
    }
    .chip.purple:hover{ border-color: rgba(168,85,255,.42); box-shadow: var(--glowP); }
    .chip .dot{
      width:8px; height:8px; border-radius:50%;
      background: var(--c);
      box-shadow: 0 0 12px rgba(24,247,255,.7);
    }
    .chip.purple .dot{background:var(--p); box-shadow: 0 0 12px rgba(168,85,255,.7);}
    .chip.primary .dot{background:#001012; box-shadow:none;}

    /* Hero */
    .hero{
      padding: 56px 0 30px;
    }
    .heroGrid{
      display:grid;
      grid-template-columns: 1.15fr .85fr;
      gap: 22px;
      align-items:stretch;
    }
    @media (max-width: 980px){
      .heroGrid{grid-template-columns: 1fr; }
      .brand{min-width:auto}
    }

    .kicker{
      display:inline-flex;
      align-items:center;
      gap:10px;
      padding: 10px 12px;
      border-radius: 999px;
      background: rgba(255,255,255,.05);
      border:1px solid rgba(255,255,255,.10);
      color: rgba(255,255,255,.82);
      font-size: 13px;
      letter-spacing:.04em;
      box-shadow: 0 10px 30px rgba(0,0,0,.25);
      width: fit-content;
    }
    .kicker .pill{
      padding:6px 10px;
      border-radius:999px;
      background: rgba(24,247,255,.10);
      border: 1px solid rgba(24,247,255,.22);
      color: rgba(24,247,255,.95);
      box-shadow: var(--glowC);
      font-weight:700;
    }

    .headline{
      margin: 18px 0 10px;
      font-size: clamp(36px, 4.6vw, 64px);
      line-height:1.03;
      font-weight: 900;
      letter-spacing:-.02em;
      background: linear-gradient(90deg, rgba(24,247,255,.96), rgba(168,85,255,.92));
      -webkit-background-clip:text;
      background-clip:text;
      color: transparent;
      text-shadow: 0 0 45px rgba(24,247,255,.12);
    }
    .subhead{
      margin: 10px 0 18px;
      color: var(--muted);
      font-size: 16px;
      line-height:1.7;
      max-width: 58ch;
    }
    .ctaRow{
      display:flex;
      gap:12px;
      flex-wrap:wrap;
      align-items:center;
      margin-top: 16px;
    }
    .btn{
      appearance:none;
      border:none;
      padding: 14px 16px;
      border-radius: 16px;
      font-weight: 800;
      cursor:pointer;
      transition: .18s ease;
      display:inline-flex;
      align-items:center;
      gap:10px;
      user-select:none;
      text-decoration:none;
    }
    .btn.primary{
      background: linear-gradient(90deg, rgb(243 132 31), rgb(22 164 216));
      color:#001012;
      box-shadow: 0 16px 50px rgba(0,0,0,.35), var(--glowC);
    }
    .btn.primary:hover{ transform: translateY(-2px); filter:saturate(1.1); box-shadow: 0 18px 60px rgba(0,0,0,.45), var(--glowP);}
    .btn.ghost{
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.86);
    }
    .btn.ghost:hover{ transform: translateY(-2px); border-color: rgba(255,255,255,.26); }
    .mini{
      display:flex;
      gap:12px;
      margin-top:16px;
      flex-wrap:wrap;
      color: rgba(255,255,255,.70);
      font-size: 13px;
    }
    .mini span{
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding: 10px 12px;
      background: rgba(255,255,255,.04);
      border:1px solid rgba(255,255,255,.10);
      border-radius: 999px;
    }
    .badge{
      width:10px; height:10px;
      border-radius:50%;
      background: rgba(43,255,136,.95);
      box-shadow: 0 0 14px rgba(43,255,136,.65);
    }

    /* Right hero card: interactive demo */
    .panel{
      border-radius: 22px;
      border: 1px solid rgba(255,255,255,.12);
      background: linear-gradient(180deg, rgba(255,255,255,.07), rgba(255,255,255,.03));
      box-shadow: var(--shadow);
      overflow:hidden;
      position:relative;
    }
    .panel::before{
      content:"";
      position:absolute; inset:-1px;
      background: radial-gradient(800px 300px at 30% 10%, rgba(24,247,255,.16), transparent 60%),
                  radial-gradient(700px 260px at 80% 20%, rgba(168,85,255,.14), transparent 62%);
      pointer-events:none;
      opacity:.9;
    }
    .panelHeader{
      position:relative;
      padding: 16px 16px 12px;
      border-bottom: 1px solid rgba(255,255,255,.10);
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:10px;
    }
    .panelHeader .title{
      display:flex; flex-direction:column; gap:2px;
    }
    .panelHeader h3{
      margin:0;
      font-size:14px;
      letter-spacing:.12em;
      text-transform:uppercase;
      color: rgba(255,255,255,.86);
    }
    .panelHeader p{
      margin:0;
      font-size:12px;
      color: rgba(255,255,255,.62);
    }
    .toggles{
      display:flex;
      align-items:center;
      gap:8px;
      flex-wrap:wrap;
      justify-content:flex-end;
    }
    .toggle{
      font-size:12px;
      padding: 8px 10px;
      border-radius: 999px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.04);
      color: rgba(255,255,255,.78);
      cursor:pointer;
      transition: .18s ease;
      user-select:none;
    }
    .toggle.active{
      border-color: rgba(24,247,255,.35);
      color: rgba(24,247,255,.95);
      box-shadow: var(--glowC);
    }

    .chat{
      position:relative;
      padding: 14px 14px 12px;
      height: 420px;
      display:flex;
      flex-direction:column;
      gap: 10px;
    }
    @media (max-width: 980px){
      .chat{ height: 380px; }
    }
    .stream{
      flex:1;
      overflow:auto;
      padding-right: 6px;
      scroll-behavior:smooth;
    }
    .msg{
      display:flex;
      gap:10px;
      margin: 10px 0;
      align-items:flex-end;
    }
    .msg.ai{justify-content:flex-start}
    .msg.user{justify-content:flex-end}
    .bubble{
      max-width: 86%;
      padding: 12px 12px;
      border-radius: 16px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.05);
      color: rgba(255,255,255,.86);
      line-height:1.45;
      box-shadow: 0 10px 25px rgba(0,0,0,.25);
      position:relative;
      overflow:hidden;
    }
    .msg.ai .bubble{
      border-color: rgba(24,247,255,.18);
      background: linear-gradient(180deg, rgba(24,247,255,.08), rgba(255,255,255,.04));
    }
    .msg.user .bubble{
      border-color: rgba(168,85,255,.22);
      background: linear-gradient(180deg, rgba(168,85,255,.10), rgba(255,255,255,.04));
      text-align:right;
    }
    .meta{
      font-size: 11px;
      color: rgba(255,255,255,.55);
      margin-top: 6px;
      display:flex;
      gap:10px;
      justify-content:space-between;
    }
    .who{
      display:inline-flex; align-items:center; gap:6px;
    }
    .who .spark{
      width:8px; height:8px; border-radius:50%;
      background: var(--c);
      box-shadow: 0 0 12px rgba(24,247,255,.7);
    }
    .msg.user .who .spark{ background: var(--p); box-shadow: 0 0 12px rgba(168,85,255,.65); }

    .composer{
      display:flex;
      gap:10px;
      padding-top: 10px;
      border-top: 1px solid rgba(255,255,255,.10);
    }
    .input{
      flex:1;
      padding: 12px 12px;
      border-radius: 14px;
      border:1px solid rgba(255,255,255,.14);
      background: rgba(0,0,0,.35);
      color: rgba(255,255,255,.90);
      outline:none;
    }
    .input:focus{
      border-color: rgba(24,247,255,.35);
      box-shadow: var(--glowC);
    }
    .send{
      padding: 12px 14px;
      border-radius: 14px;
      border:none;
      cursor:pointer;
      font-weight:900;
      color:#001012;
      background: linear-gradient(90deg, rgba(24,247,255,.95), rgba(168,85,255,.85));
      box-shadow: 0 16px 45px rgba(0,0,0,.35);
      transition:.18s ease;
    }
    .send:hover{ transform: translateY(-1px); box-shadow: 0 18px 55px rgba(0,0,0,.45), var(--glowP); }

    /* Sections */
    section{padding: 56px 0}
    .sectionTitle{
      display:flex;
      align-items:flex-end;
      justify-content:space-between;
      gap:14px;
      margin-bottom: 18px;
      flex-wrap:wrap;
    }
    .sectionTitle h2{
      margin:0;
      font-size: 30px;
      letter-spacing:-.02em;
      background: linear-gradient(90deg, rgba(255,255,255,.92), rgba(24,247,255,.85));
      -webkit-background-clip:text;
      background-clip:text;
      color:transparent;
    }
    .sectionTitle p{
      margin:0;
      color: var(--muted);
      max-width: 62ch;
      line-height:1.6;
      font-size: 14px;
    }

    .grid{
      display:grid;
      gap: 14px;
    }
    .grid.features{ grid-template-columns: repeat(3, 1fr); }
    @media (max-width: 980px){ .grid.features{ grid-template-columns: 1fr; } }

    .card{
      border-radius: 20px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
      box-shadow: var(--shadow);
      padding: 16px 16px;
      position:relative;
      overflow:hidden;
      transition: .18s ease;
      min-height: 150px;
    }
    .card:hover{
      transform: translateY(-2px);
      border-color: rgba(24,247,255,.28);
      box-shadow: 0 20px 60px rgba(0,0,0,.55), var(--glowC);
    }
    .card .icon{
      width: 44px; height: 44px;
      border-radius: 14px;
      display:grid; place-items:center;
      background: rgba(24,247,255,.10);
      border: 1px solid rgba(24,247,255,.18);
      box-shadow: 0 10px 30px rgba(0,0,0,.25);
      margin-bottom: 12px;
    }
    .card .icon svg{width:22px; height:22px; fill:none; stroke: rgba(24,247,255,.95); stroke-width:2.2}
    .card h3{margin:0 0 6px; font-size: 18px}
    .card p{margin:0; color: var(--muted); line-height:1.6; font-size: 14px}

    /* How it works */
    .steps{
      display:grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
    }
    @media (max-width: 980px){ .steps{ grid-template-columns: 1fr; } }

    .step{
      border-radius: 20px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
      box-shadow: var(--shadow);
      padding: 16px;
      position:relative;
      overflow:hidden;
    }
    .step .num{
      width: 44px; height: 44px; border-radius: 999px;
      display:grid; place-items:center;
      font-weight: 900;
      color:#001012;
      background: linear-gradient(90deg, rgba(24,247,255,.95), rgba(168,85,255,.85));
      box-shadow: var(--glowC);
      margin-bottom: 10px;
    }
    .step h4{margin:0 0 6px; font-size: 16px}
    .step p{margin:0; color: var(--muted); line-height:1.6; font-size: 13.5px}

    /* Pricing */
    .pricing{
      display:grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
    }
    @media (max-width: 980px){ .pricing{ grid-template-columns: 1fr; } }

    .plan{
      border-radius: 22px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
      box-shadow: var(--shadow);
      padding: 18px;
      position:relative;
      overflow:hidden;
      transition:.18s ease;
    }
    .plan:hover{
      transform: translateY(-2px);
      border-color: rgba(168,85,255,.25);
      box-shadow: 0 20px 60px rgba(0,0,0,.55), var(--glowP);
    }
    .plan.featured{
      border-color: rgba(24,247,255,.32);
      background: linear-gradient(180deg, rgba(24,247,255,.08), rgba(168,85,255,.06));
      box-shadow: 0 20px 60px rgba(0,0,0,.55), var(--glowC);
    }
    .plan .top{
      display:flex; align-items:center; justify-content:space-between; gap:10px;
      margin-bottom: 10px;
    }
    .plan .name{
      font-weight: 900;
      font-size: 18px;
      letter-spacing:.01em;
    }
    .plan .tag{
      font-size: 12px;
      padding: 8px 10px;
      border-radius: 999px;
      border:1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.04);
      color: rgba(255,255,255,.78);
    }
    .price{
      margin: 8px 0 12px;
      font-size: 34px;
      font-weight: 950;
      letter-spacing:-.02em;
      background: linear-gradient(90deg, rgba(168,85,255,.92), rgba(24,247,255,.88));
      -webkit-background-clip:text;
      background-clip:text;
      color:transparent;
    }
    .per{font-size: 13px; color: var(--muted); margin-top:-8px}
    .list{margin: 14px 0 0; padding:0; list-style:none; display:grid; gap:10px}
    .li{
      display:flex; gap:10px; align-items:flex-start;
      color: rgba(255,255,255,.76);
      font-size: 14px;
      line-height:1.5;
    }
    .tick{
      width: 18px; height:18px; border-radius: 6px;
      background: rgba(43,255,136,.14);
      border: 1px solid rgba(43,255,136,.30);
      box-shadow: 0 0 16px rgba(43,255,136,.25);
      display:grid; place-items:center;
      flex:0 0 auto;
      margin-top: 2px;
    }
    .tick svg{width: 12px; height:12px; stroke: rgba(43,255,136,.95); stroke-width: 2.5; fill:none}
    .plan .choose{
      margin-top: 16px;
      width:100%;
      justify-content:center;
    }

    /* Role cards / links */
    .roles{
      display:grid;
      grid-template-columns: repeat(3,1fr);
      gap: 14px;
    }
    @media (max-width: 980px){ .roles{ grid-template-columns: 1fr; } }

    .role{
      border-radius: 22px;
      border:1px solid rgba(255,255,255,.10);
      background: rgba(255,255,255,.04);
      box-shadow: var(--shadow);
      padding: 18px;
      position:relative;
      overflow:hidden;
    }
    .role h3{margin: 0 0 6px; font-size: 18px}
    .role p{margin:0; color: var(--muted); line-height:1.6; font-size: 14px}
    .role .row{
      display:flex; gap:10px; flex-wrap:wrap; margin-top: 12px;
    }
    .role a.btn{
      padding: 12px 14px;
      border-radius: 14px;
    }

    /* Footer */
    footer{
      padding: 28px 0 40px;
      border-top: 1px solid rgba(255,255,255,.08);
      color: rgba(255,255,255,.55);
      font-size: 13px;
      text-align:center;
    }

    /* reveal animation */
    .reveal{
      opacity:0;
      transform: translateY(16px);
      transition: .65s cubic-bezier(.2,.8,.2,1);
    }
    .reveal.on{
      opacity:1;
      transform: translateY(0);
    }

    /* custom scrollbar (optional) */
    .stream::-webkit-scrollbar{width:10px}
    .stream::-webkit-scrollbar-thumb{
      background: rgba(255,255,255,.10);
      border: 2px solid rgba(0,0,0,.35);
      border-radius: 999px;
    }
    .stream::-webkit-scrollbar-thumb:hover{ background: rgba(255,255,255,.16); }
  </style>
</head>

<body>
  <canvas id="fx"></canvas>
  <div class="blob c"></div>
  <div class="blob p"></div>
  <div class="blob g"></div>

  <div class="wrap">
    <header class="topbar">
      <div class="container">
        <div class="nav">
          <div class="brand">
            <a class="logo" href="/" aria-label="Ezead Home">
              <!-- Replace with your actual Ezead logo path if different -->
              <img src="https://eze.pics/ezead-chat-images/logo2.png" alt="Ezead Logo" onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=&quot;font-weight:900;color:rgba(24,247,255,.95)&quot;>E</span>';" />
            </a>
            <!--<div>-->
            <!--  <h1>EZEAD SUPPORT AI</h1>-->
            <!--  <div class="tag">SaaS • AI Agent + Live Support</div>-->
            <!--</div>-->
          </div>

          <nav class="navlinks" aria-label="Primary">
            <a class="chip primary" href="#get-started"><span class="dot"></span>Get Started</a>
            <a class="chip" href="#features"><span class="dot"></span>Features</a>
            <a class="chip purple" href="#pricing"><span class="dot"></span>Pricing</a>
            <!--<a class="chip" href="#how"><span class="dot"></span>How it works</a>-->

            <!-- 3 requested links -->
            <a class="chip" href="company/login" title="Company Portal"><span class="dot"></span>Company Login</a>
            <a class="chip" href="/admin/login" title="Admin Console"><span class="dot"></span>Admin Login</a>
            <a class="chip purple" href="/agent/login" title="Agent Desk"><span class="dot"></span>Agent Login</a>
          </nav>
        </div>
      </div>
    </header>

    <main id="top">
      <div class="container">
        <section class="hero">
          <div class="heroGrid">
            <div class="reveal">
              <div class="kicker">
                <span class="pill">AI + Human Hybrid</span>
                <span>Instant replies • Smart routing • Analytics • Automation</span>
              </div>

              <h2 class="headline">AI-Powered SaaS Support Chat System</h2>
              <p class="subhead">
                Deliver lightning-fast customer support with an AI Agent that resolves FAQs, triages requests,
                and escalates to the right human agent automatically—while admins get full analytics and control.
              </p>

              <div class="ctaRow" id="get-started">
                <a class="btn primary" href="#roles" role="button" aria-label="Launch portals">
                  <span>Launch Portals</span>
                  <span aria-hidden="true">→</span>
                </a>
                <button class="btn ghost" id="demoBtn" type="button">Run Interactive Demo</button>
                <button class="btn ghost" id="themeBtn" type="button">Toggle Glow Mode</button>
              </div>

              <div class="mini">
                <span><i class="badge"></i> Role-based access (Company / Admin / Agent)</span>
                <span><i class="badge"></i> Real-time chat + conversation history</span>
                <span><i class="badge"></i> AI Agent with knowledge-base answers</span>
              </div>
            </div>

            <!-- Demo panel -->
            <div class="panel reveal" aria-label="Interactive Chat Demo">
              <div class="panelHeader">
                <div class="title">
                  <h3>Live Demo — AI Agent</h3>
                  <p>Try typical support questions (billing, onboarding, reset password)</p>
                </div>
                <div class="toggles">
                  <button class="toggle active" id="modeAi" type="button">AI Mode</button>
                  <button class="toggle" id="modeAgent" type="button">Agent Mode</button>
                </div>
              </div>

              <div class="chat">
                <div class="stream" id="stream" aria-live="polite"></div>
                <div class="composer">
                  <input class="input" id="input" placeholder="Type a message… (e.g., 'How do I add an agent?')" />
                  <button class="send" id="send" type="button">Send</button>
                </div>
              </div>
            </div>

          </div>
        </section>

        <section id="features">
          <div class="sectionTitle reveal">
            <div>
              <h2>Everything you built — made self-explanatory</h2>
              <p>
                A complete support platform: real-time chat, AI automation, role dashboards, secure access,
                and data-driven optimization—wrapped in an interactive UI.
              </p>
            </div>
          </div>

          <div class="grid features">
            <article class="card reveal">
              <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
              </div>
              <h3>Live Chat + History</h3>
              <p>Real-time messaging, transcripts, internal notes, tags, and customer timeline—built for fast resolution.</p>
            </article>

            <article class="card reveal">
              <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M12 2a4 4 0 0 0-4 4v2H6a3 3 0 0 0-3 3v6a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-6a3 3 0 0 0-3-3h-2V6a4 4 0 0 0-4-4z"/><path d="M9 14h6"/></svg>
              </div>
              <h3>Enterprise Security</h3>
              <p>Role-based permissions, audit-friendly actions, and safe-by-default design for SaaS multi-tenant usage.</p>
            </article>

            <article class="card reveal">
              <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M12 2v6"/><path d="M8 4h8"/><path d="M6 22h12"/><path d="M7 22V10a5 5 0 0 1 10 0v12"/></svg>
              </div>
              <h3>AI Agent Layer</h3>
              <p>Instant answers, intent detection, knowledge-based responses, and smart escalation to human agents.</p>
            </article>

            <article class="card reveal">
              <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M4 19V5"/><path d="M4 19h16"/><path d="M7 16l3-6 4 4 3-7"/></svg>
              </div>
              <h3>Analytics Dashboard</h3>
              <p>Measure CSAT, response time, AI resolution rate, agent performance, and conversation trends.</p>
            </article>

            <article class="card reveal">
              <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9z"/></svg>
              </div>
              <h3>Automation Workflows</h3>
              <p>Auto-assign, route by skill, trigger follow-ups, escalate rules, and integrate webhooks—hands-free ops.</p>
            </article>

            <article class="card reveal">
              <div class="icon" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M12 21s7-4.35 7-10a7 7 0 0 0-14 0c0 5.65 7 10 7 10z"/><path d="M9 10h6"/></svg>
              </div>
              <h3>Multi-Channel Ready</h3>
              <p>Embed on websites, apps, portals—single unified inbox. Consistent branding + customizable widget.</p>
            </article>
          </div>
        </section>

        <section id="how">
          <div class="sectionTitle reveal">
            <div>
              <h2>How it works</h2>
              <p>From first message to resolution—AI handles the first layer, humans handle the edge cases, and analytics improve everything.</p>
            </div>
          </div>

          <div class="steps">
            <div class="step reveal">
              <div class="num">1</div>
              <h4>Customer initiates chat</h4>
              <p>Widget loads instantly on your site/app. Conversations start with minimal friction.</p>
            </div>
            <div class="step reveal">
              <div class="num">2</div>
              <h4>AI responds in seconds</h4>
              <p>AI answers FAQs, collects structured info, and detects intent + urgency.</p>
            </div>
            <div class="step reveal">
              <div class="num">3</div>
              <h4>Smart escalation to agents</h4>
              <p>Complex queries are routed to the right agent based on skills, workload, and rules.</p>
            </div>
            <div class="step reveal">
              <div class="num">4</div>
              <h4>Insights & continuous improvement</h4>
              <p>Admins monitor trends and optimize AI + workflows to increase resolution rate.</p>
            </div>
          </div>
        </section>

        <section id="pricing">
          <div class="sectionTitle reveal">
            <div>
              <h2>Pricing</h2>
              <p>Dummy pricing you can replace later. Structured for SaaS tiers (Starter → Pro → Enterprise).</p>
            </div>
          </div>

          <div class="pricing">
            <div class="plan reveal">
              <div class="top">
                <div class="name">Starter</div>
                <div class="tag">For small teams</div>
              </div>
              <div class="price">$29</div>
              <div class="per">per month (dummy)</div>
              <ul class="list">
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>1 admin workspace</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Up to 3 agents</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Basic AI replies</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Standard analytics</li>
              </ul>
              <a class="btn primary choose" href="#roles">Choose Starter</a>
            </div>

            <div class="plan featured reveal">
              <div class="top">
                <div class="name">Professional</div>
                <div class="tag">Most popular</div>
              </div>
              <div class="price">$79</div>
              <div class="per">per month (dummy)</div>
              <ul class="list">
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Multiple teams / inboxes</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Up to 15 agents</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Advanced AI training</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Automation workflows</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Priority support</li>
              </ul>
              <a class="btn primary choose" href="#roles">Choose Pro</a>
            </div>

            <div class="plan reveal">
              <div class="top">
                <div class="name">Enterprise</div>
                <div class="tag">Custom</div>
              </div>
              <div class="price">Custom</div>
              <div class="per">let’s talk (dummy)</div>
              <ul class="list">
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Unlimited agents</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Dedicated infrastructure</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Custom AI model + policies</li>
                <li class="li"><span class="tick"><svg viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg></span>Advanced security + SSO</li>
              </ul>
              <a class="btn primary choose" href="#roles">Contact Sales</a>
            </div>
          </div>
        </section>

        <section id="roles">
          <div class="sectionTitle reveal">
            <div>
              <h2>Portals</h2>
              <p>Three entry points (as you requested): Company portal, Admin console, and Agent desk.</p>
            </div>
          </div>

          <div class="roles">
            <div class="role reveal">
              <h3>Company</h3>
              <p>Manage organization profile, channels, team structure, branding, billing, and support policies.</p>
              <div class="row">
                <a class="btn primary" href="/company/login">Open Company Portal →</a>
                <a class="btn ghost" href="#features">View Features</a>
              </div>
            </div>

            <div class="role reveal">
              <h3>Admin</h3>
              <p>Configure AI knowledge, routing rules, automation workflows, analytics, and compliance settings.</p>
              <div class="row">
                <a class="btn primary" href="/admin/login">Open Admin Console →</a>
                <a class="btn ghost" href="#how">See Process</a>
              </div>
            </div>

            <div class="role reveal">
              <h3>Agent</h3>
              <p>Unified inbox, customer context, AI assist, canned replies, tags, SLA indicators, and handoffs.</p>
              <div class="row">
                <a class="btn primary" href="/agent/login">Open Agent Desk →</a>
                <button class="btn ghost" id="agentDemoBtn" type="button">Try Agent Mode</button>
              </div>
            </div>
          </div>
        </section>

      </div>
    </main>

    <footer>
      ©2003- 2026 Ezead Media Group — Powered by Ezead AI
    </footer>
  </div>

  <script>
    // ---------------------------
    // 1) Reveal on scroll
    // ---------------------------
    const revealEls = Array.from(document.querySelectorAll('.reveal'));
    const io = new IntersectionObserver((entries) => {
      for (const e of entries) {
        if (e.isIntersecting) e.target.classList.add('on');
      }
    }, { threshold: 0.12 });
    revealEls.forEach(el => io.observe(el));

    document.getElementById('year').textContent = new Date().getFullYear();

    // ---------------------------
    // 2) Theme "Glow Mode" toggle
    // ---------------------------
    let glow = true;
    const themeBtn = document.getElementById('themeBtn');
    themeBtn.addEventListener('click', () => {
      glow = !glow;
      document.body.style.filter = glow ? 'none' : 'saturate(.85) contrast(1.03)';
      document.getElementById('fx').style.opacity = glow ? '.8' : '.35';
      themeBtn.textContent = glow ? 'Toggle Glow Mode' : 'Enable Glow Mode';
    });

    // ---------------------------
    // 3) Interactive chat demo (AI/Agent)
    // ---------------------------
    const stream = document.getElementById('stream');
    const input = document.getElementById('input');
    const sendBtn = document.getElementById('send');
    const demoBtn = document.getElementById('demoBtn');
    const agentDemoBtn = document.getElementById('agentDemoBtn');
    const modeAiBtn = document.getElementById('modeAi');
    const modeAgentBtn = document.getElementById('modeAgent');

    let mode = 'ai'; // 'ai' | 'agent'

    function setMode(next){
      mode = next;
      modeAiBtn.classList.toggle('active', mode === 'ai');
      modeAgentBtn.classList.toggle('active', mode === 'agent');
      pushSystem(mode === 'ai'
        ? "AI Mode enabled. Ask anything about onboarding, billing, agents, routing, or analytics."
        : "Agent Mode enabled. You are chatting with a human agent (simulated)."
      );
    }

    modeAiBtn.addEventListener('click', () => setMode('ai'));
    modeAgentBtn.addEventListener('click', () => setMode('agent'));
    agentDemoBtn.addEventListener('click', () => setMode('agent'));

    function el(tag, cls, text){
      const n = document.createElement(tag);
      if (cls) n.className = cls;
      if (text !== undefined) n.textContent = text;
      return n;
    }

    function pushMessage(who, text){
      const row = el('div', 'msg ' + who);
      const bubble = el('div', 'bubble');
      const content = el('div', '', text);
      const meta = el('div', 'meta');

      const whoEl = el('div', 'who');
      const spark = el('span', 'spark');
      const label = el('span', '', who === 'ai' ? (mode === 'ai' ? 'AI Agent' : 'Support Agent') : 'You');

      whoEl.appendChild(spark);
      whoEl.appendChild(label);

      const time = el('span', '', new Date().toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'}));

      meta.appendChild(whoEl);
      meta.appendChild(time);

      bubble.appendChild(content);
      bubble.appendChild(meta);
      row.appendChild(bubble);
      stream.appendChild(row);
      stream.scrollTop = stream.scrollHeight;
    }

    function pushSystem(text){
      // system-style uses AI bubble
      pushMessage('ai', text);
    }

    function typingIndicator(){
      const row = el('div', 'msg ai');
      const bubble = el('div', 'bubble');
      bubble.innerHTML = '<span style="opacity:.85">Typing</span><span class="dots" style="margin-left:6px">•••</span>';
      row.appendChild(bubble);
      stream.appendChild(row);
      stream.scrollTop = stream.scrollHeight;

      let i = 0;
      const t = setInterval(() => {
        i++;
        const dots = bubble.querySelector('.dots');
        if (!dots) return;
        dots.textContent = '•'.repeat((i % 3) + 1);
      }, 240);

      return () => { clearInterval(t); row.remove(); };
    }

    function normalize(s){ return (s || '').trim().toLowerCase(); }

    function aiReply(userText){
      const t = normalize(userText);

      // quick intent matching for “self explanatory”
      if (t.includes('price') || t.includes('pricing') || t.includes('plan')) {
        return "We offer Starter, Professional, and Enterprise tiers. Starter is great for small teams, Pro unlocks advanced AI training + workflows, and Enterprise adds custom infrastructure + SSO. (Replace dummy pricing with real values anytime.)";
      }
      if (t.includes('add agent') || t.includes('invite agent') || t.includes('agent')) {
        return "Admins can invite agents from the Admin Console → Team → Invite. You can assign skills, working hours, and routing rules so chats auto-assign to the best available agent.";
      }
      if (t.includes('reset') || t.includes('password')) {
        return "To reset your password: open the Company portal login → 'Forgot password' → verify email/OTP → set new password. Admins can also enforce SSO or MFA policies.";
      }
      if (t.includes('analytics') || t.includes('dashboard') || t.includes('csat')) {
        return "The Analytics Dashboard tracks response time, AI resolution rate, agent productivity, conversation volume, and CSAT. Use it to refine routing rules and improve the AI knowledge base.";
      }
      if (t.includes('automation') || t.includes('workflow') || t.includes('route') || t.includes('routing')) {
        return "Automation workflows can auto-tag chats, trigger escalation, assign priority, and route by department or skill. Example: billing → finance queue; technical → L2 agents; VIP → priority lane.";
      }
      if (t.includes('knowledge') || t.includes('train') || t.includes('kb')) {
        return "Train the AI Agent by uploading FAQs/Docs or past conversation snippets. The AI uses your knowledge base to respond, then escalates to humans when confidence is low.";
      }
      if (t.includes('integration') || t.includes('webhook') || t.includes('api')) {
        return "Integrations can be done via webhooks/API: create tickets, sync CRM fields, post alerts to Slack/Email, and log conversation events for reporting.";
      }
      if (t.includes('hello') || t.includes('hi') || t.includes('hey')) {
        return "Hey! I’m the Ezead Support AI. Ask me about pricing, onboarding, adding agents, routing rules, analytics, or automations.";
      }

      return "Got it. In our platform, the AI Agent handles instant replies + triage, then escalates to a human agent when needed. If you tell me the topic (billing/technical/onboarding), I’ll guide the best next step.";
    }

    function agentReply(userText){
      const t = normalize(userText);
      if (t.includes('refund')) return "I can help with that. Please share your invoice ID and the reason for refund. I’ll verify eligibility and process it.";
      if (t.includes('bug') || t.includes('error')) return "Sorry about that—can you share a screenshot and steps to reproduce? I’ll escalate it to the technical queue with priority if needed.";
      if (t.includes('upgrade') || t.includes('plan')) return "Sure—tell me your current plan and expected number of agents. I’ll recommend the best tier for your usage.";
      return "Thanks—I'm here. Could you share a bit more detail (account email + what you were trying to do)? I’ll take it from there.";
    }

    async function handleSend(){
      const text = input.value.trim();
      if (!text) return;

      pushMessage('user', text);
      input.value = "";

      const stopTyping = typingIndicator();
      await new Promise(r => setTimeout(r, 450 + Math.random() * 550));
      stopTyping();

      const reply = mode === 'ai' ? aiReply(text) : agentReply(text);
      pushMessage('ai', reply);
    }

    sendBtn.addEventListener('click', handleSend);
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') handleSend();
    });

    demoBtn.addEventListener('click', () => {
      setMode('ai');
      const samples = [
        "How do I add an agent?",
        "What analytics do you provide?",
        "Explain your automation workflows.",
        "How do I reset my password?"
      ];
      const pick = samples[Math.floor(Math.random() * samples.length)];
      input.value = pick;
      input.focus();
    });

    // initial messages
    pushSystem("Welcome! This is a demo of your SaaS Support Chat system UI.");
    pushSystem("Tip: Ask about pricing, onboarding, adding agents, routing, analytics, or automations.");

    // ---------------------------
    // 4) Neon particles / interactive background
    // ---------------------------
    const canvas = document.getElementById('fx');
    const ctx = canvas.getContext('2d', { alpha: true });
    let W, H, DPR;

    function resize(){
      DPR = Math.min(window.devicePixelRatio || 1, 2);
      W = Math.floor(window.innerWidth);
      H = Math.floor(window.innerHeight);
      canvas.width = Math.floor(W * DPR);
      canvas.height = Math.floor(H * DPR);
      canvas.style.width = W + 'px';
      canvas.style.height = H + 'px';
      ctx.setTransform(DPR,0,0,DPR,0,0);
    }
    window.addEventListener('resize', resize);
    resize();

    const rand = (a,b)=> a + Math.random()*(b-a);

    const palette = [
      { r:24, g:247, b:255 },  // cyan
      { r:168, g:85, b:255 },  // purple
      { r:43, g:255, b:136 }   // green
    ];

    let mouse = { x: W*0.5, y: H*0.35, active:false };
    window.addEventListener('mousemove', (e)=>{ mouse.x=e.clientX; mouse.y=e.clientY; mouse.active=true; });
    window.addEventListener('mouseleave', ()=>{ mouse.active=false; });

    const DOTS = Math.min(120, Math.floor((W*H)/18000));
    const dots = Array.from({length: DOTS}, ()=> {
      const c = palette[Math.floor(Math.random()*palette.length)];
      return {
        x: rand(0,W),
        y: rand(0,H),
        vx: rand(-.25,.25),
        vy: rand(-.25,.25),
        r: rand(1.2, 2.4),
        c,
      };
    });

    function draw(){
      ctx.clearRect(0,0,W,H);

      // dots
      for (const d of dots){
        d.x += d.vx; d.y += d.vy;
        if (d.x < -50) d.x = W+50;
        if (d.x > W+50) d.x = -50;
        if (d.y < -50) d.y = H+50;
        if (d.y > H+50) d.y = -50;

        // mouse attraction
        const mx = mouse.active ? mouse.x : W*0.5;
        const my = mouse.active ? mouse.y : H*0.35;
        const dx = mx - d.x;
        const dy = my - d.y;
        const dist = Math.sqrt(dx*dx + dy*dy) || 1;
        const pull = Math.max(0, 1 - dist/420) * 0.010;
        d.vx += (dx/dist) * pull;
        d.vy += (dy/dist) * pull;

        // damp
        d.vx *= 0.995;
        d.vy *= 0.995;

        ctx.beginPath();
        ctx.arc(d.x, d.y, d.r, 0, Math.PI*2);
        ctx.fillStyle = `rgba(${d.c.r},${d.c.g},${d.c.b},0.55)`;
        ctx.fill();
      }

      // lines
      for (let i=0;i<dots.length;i++){
        for (let j=i+1;j<dots.length;j++){
          const a = dots[i], b = dots[j];
          const dx = a.x-b.x, dy = a.y-b.y;
          const dist2 = dx*dx + dy*dy;
          const max = 140;
          if (dist2 < max*max){
            const t = 1 - (Math.sqrt(dist2)/max);
            ctx.strokeStyle = `rgba(24,247,255,${0.10*t})`;
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(a.x,a.y);
            ctx.lineTo(b.x,b.y);
            ctx.stroke();
          }
        }
      }

      requestAnimationFrame(draw);
    }
    draw();
  </script>
</body>
</html>