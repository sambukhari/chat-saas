<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://eze.pics/ezead-com/public/favicon/favicon-32x32.png" title="Powered by Ezead AI">
    <title>EzeAD Support AI – SaaS AI Chat & Customer Support Platform</title>
    <meta name="description"
        content="AI-powered SaaS support chat with live agents, smart automation, analytics and real-time customer engagement tools for businesses and marketplaces." />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
            h1, h2, h3, h4, h5, h6,
            p,
            figure,
            span,
            a {
                margin: 0;
                padding: 0;
            }

        html {
            scroll-behavior: smooth;
            -webkit-text-size-adjust: 100%;
        }

        body {
            background:#f9f9f9;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }


        img,
        picture,
        video,
        canvas,
        svg {
            display: block;
            max-width: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul,
        ol {
            list-style: none;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
            border: none;
            outline: none;
            background: none;
        }

        .light_header {
            width: 100%;
            background: #0074A3;
            padding: 14px 0;
        }

        .light_header img {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .light_header .light_nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .light_header .light_logo {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 140px;
            height: 50px;
            background: #fff;
            border-radius: 40px;
        }

        .light_header .light_logo img {
            width: 80%;
            height: auto;
            display: block;
            aspect-ratio: 224 / 63;
        }



        .light_header .light_nav_links {
            display: flex;
            gap: 18px;
            align-items: center;
        }

        .light_header .light_nav_links a {
            font-size: 16px;
            line-height: 22px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 30px;
            background: rgba(0, 90, 130, 0.4);
            border:1px solid rgba(0, 90, 130, 0.4);
            transition: .3s ease;
            text-decoration: none;
        }
        .light_header .light_nav_links a:hover {
            border-color:#fff;
        }
        .light_header .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            color: #fff;
            background: #fff;
        }

        .light_header .light_nav_links svg {
            width: 6px;
            height: 6px;
            fill: currentColor;
        }

        .light_header .light_toggle {
            width: 35px;
            height: 35px;
            border-radius: 5px;
            border: 1px solid #fff;
            display: none;
            background: none;
            cursor: pointer;
            color: #fff;
        }

        .light_header .light_toggle svg {
            width: 22px;
            height: 22px;
            stroke: currentColor;
        }

        .light_header .light_sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: #fff;
            padding: 20px 10px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transform: translateX(-100%);
            transition: transform .3s ease;
            z-index: 2000;
        }

        .light_header .light_sidebar.active {
            transform: translateX(0);
        }

        .light_header .light_sidebar_top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #666;
            padding-bottom: 20px;
        }

        .light_header .light_sidebar_top img {
            height: 40px;
            width: 130px;
            object-fit: contain;
        }

        .light_header .light_sidebar_top button {
            width: 35px;
            height: 35px;
            border: 2px solid rgba(0, 90, 130, 0.4);
            border-radius: 5px;
            color:#272343;
            background: none;
            cursor: pointer;
        }
        .light_header .light_sidebar_top button:hover {
            background: #0074A3;
            color:#fff;
        }

        .light_header .light_sidebar_links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .light_header .light_sidebar_links a {
             font-size: 12px;
            line-height: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 30px;
            background: rgba(0, 90, 130, 0.4);
            border:1px solid rgba(0, 90, 130, 0.4);
            transition: .3s ease;
            text-decoration: none;
        }

        .light_header .light_overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .4);
            opacity: 0;
            visibility: hidden;
            transition: .3s ease;
            z-index: 1500;
        }

        .light_header .light_overlay.active {
            opacity: 1;
            visibility: visible;
        }
        @media screen and (max-width:1199px){
            .light_header .light_nav_links a {
            font-size: 14px;
            line-height: 20px;
            padding: 8px 12px;
            }
        }
        @media screen and (max-width: 991px) {
            .container {
                max-width: 959px;
            }
            .light_header {
                padding: 10px 0px;
            }
            .light_header .light_logo {
                width: 100px;
                height: 40px;
        }
            .light_header .light_nav_links a {
                font-size: 12px;
                line-height: 18px;
                padding: 6px 10px;
            }
            .light_header .light_nav_links {
                display: flex;
                gap: 10px
                
            }
        }
        
        @media screen and (max-width:767px) {
            .light_header .light_nav_links {
                display: none
            }

            .light_header .light_toggle {
                display: block
            }
        }
    </style>
    <style>
    .hero{
            padding:70px 0px;
            overflow:hidden;
            position: relative;
            z-index: 1;
        }
        .hero .blurry{
            position:relative;
        }
        .hero .blurry{
          content: "";
          position: absolute;   
          right: -150px;  
          width: 400px;
          height: 400px;
          background: radial-gradient(50% 50% at 50% 50%, rgba(0, 169, 218, 0.33) 0%, rgba(0, 169, 218, 0) 100%);
          filter: blur(40px);
          pointer-events: none;
          z-index: 1;
        }
       .hero .blur1 {
            top: -150px;
            left: -12%;
            z-index: -1;
        }
        .hero .blur2 {
          position: absolute;  
          top: 0%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: -1;
        }

        .hero .blur3 {
            top:unset;
            right: 0%;
            bottom: 0%;
            z-index: -1;
            display:none;
        }
        
        .hero .blur3.active {
          display:block;
        }
       .hero  .saas {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .hero h1 {
            width: 64%;
            font-size: 40px;
            line-height: 46px;
            color: #272343;
            font-weight: 700;
        }
        .hero .saas p {
            width: 64%;
            font-size: 16px;
            line-height: 22px;
            color: #333333;
            font-weight: 400;
        }
         .hero .pill{
            font-size: 16px;
            line-height: 22px;
            font-weight: 600;
            border: 2px solid #00A9DA26;
            padding:10px;
            border-radius:20px;
            color:#666;
        }
        .hero .kicker{
            background:#fff;
            padding:15px 5px;
            border-radius:50px;
            display: flex;
            align-items: center;
            gap: 10px
        }
        .hero .fa-circle{
            position: relative;
            top: -2px;
            font-size: 6px;
            width: 8px;
        }
        .hero .instant{
            color:#333;
            font-size: 16px;
            line-height: 22px;
            font-weight: 500;
        }
        .hero .feature_list {
          list-style: none;
          padding: 0;
          margin: 0;
          display: flex;
          flex-direction: column;
          gap: 8px;
    }
        }
        
        .hero .feature_list li {
          position: relative;
          padding-left: 15px;
        }
        
        .hero .feature_list li i {
          width: 8px;
          height: 8px;
          color: #a34f02;
        }
        .hero .ctaRow {
          display: flex;
          align-items: center;
          gap: 15px;
          flex-wrap: wrap;
        }
        
        .hero .ctaRow .btn1,
        .hero .ctaRow .btn2 {
          display: inline-flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          padding: 12px 24px;
          border-radius: 50px;
          font-size: 15px;
          font-weight: 600;
          text-decoration: none;
          cursor: pointer;
          transition: all 0.3s ease;
          border: none;
        }
        
        .hero .ctaRow .btn1 {
          background: #0074A3;
          color: #fff;
        }
        
        .hero .ctaRow .btn1:hover {
          background: #333;
        }
        
        .hero .ctaRow .btn2 {
          background: transparent;
          border: 2px solid #111;
          color: #111;
        }
        
        .hero .ctaRow .btn2:hover {
          background: #111;
          color: #fff;
        }

    </style>
    <style>
        
       .hero  .parentbox {
            position: relative;
        }
      .hero #chatToggle {
            position: absolute;
            bottom: 28px;
            right: 28px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #0074A3;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 116, 163, .45);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform .2s, box-shadow .2s;
            z-index: 9999;
            display:none;
        }

      .hero   #chatToggle i {
            color: #fff;
            font-size: 22px;
            transition: opacity .2s;
        }

      .hero   #chatToggle .ico-close {
            display: none;
        }

        /* Notification dot */
      .hero   #chatToggle .notif {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ff4757;
            border: 2px solid #fff;
            font-size: 8px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        /* ── Chat Window ── */
      .hero   #chatBox {
           
            width: 370px;
            max-height: 480px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 16px 60px rgba(0, 0, 0, .18);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transform: translateY(20px) scale(.96);
            opacity: 0;
            pointer-events: none;
            transition: transform .25s cubic-bezier(.34, 1.56, .64, 1), opacity .2s ease;
            z-index: 9998;
        }

      .hero   #chatBox.open {
            transform: translateY(0) scale(1);
            opacity: 1;
            pointer-events: all;
        }

        /* Header */
      .hero   .chat-header {
            background: #0074A3;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

       .hero  .chat-header .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

       .hero  .chat-header .avatar img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

       .hero  .chat-header .info {
            display:flex;
            flex-direction:column;
        }

      .hero   .chat-header .info .support {
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.2;
        }

       .hero  .chat-header .info span {
            color: #fff;
            font-size: 12px;
        }

       .hero  .chat-header .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #2bff88;
            display: inline-block;
            margin-right: 5px;
            box-shadow: 0 0 0 3px rgba(43, 255, 136, .25);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 3px rgba(43, 255, 136, .25);
            }

            50% {
                box-shadow: 0 0 0 6px rgba(43, 255, 136, .08);
            }
        }

        .chat-header .mode-pills {
            display: flex;
            gap: 6px;
            margin-left: auto;
        }

      .hero   .mode-pill {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: rgba(0, 90, 130, 0.4);
            color: #fff;
            cursor: pointer;
            transition: background .2s;
            border: none;
        }

       .hero  .mode-pill.active {
            background: rgba(255, 255, 255, .9);
            color: #0074A3;
        }

        /* Messages */
       .hero  .chat-msgs {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            scroll-behavior: smooth;
        }

       .hero  .chat-msgs::-webkit-scrollbar {
            width: 4px;
        }

       .hero  .chat-msgs::-webkit-scrollbar-track {
            background: transparent;
        }

       .hero  .chat-msgs::-webkit-scrollbar-thumb {
            background: #d0dce8;
            border-radius: 4px;
        }

        /* Message bubbles */
       .hero  .msg-row {
            display: flex;
            gap: 8px;
            max-width: 90%;
        }

       .hero  .msg-row.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

       .hero  .msg-row.bot {
            align-self: flex-start;
        }

       .hero  .msg-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            flex-shrink: 0;
            background: #e8f4fb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #0074A3;
            font-weight: 700;
            align-self: flex-end;
        }

       .hero  .msg-row.user .msg-avatar {
            background: #0074A3;
            color: #fff;
        }

       .hero  .bubble {
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 13.5px;
            line-height: 1.5;
            max-width: 260px;
            word-break: break-word;
        }

       .hero  .msg-row.bot .bubble {
            background: #f0f6fb;
            color: #1a2a38;
            border-bottom-left-radius: 4px;
        }

       .hero  .msg-row.user .bubble {
            background: #0074A3;
            color: #fff;
            border-bottom-right-radius: 4px;
        }

       .hero  .msg-time {
            font-size: 10px;
            color: #666;
            margin-top: 4px;
            text-align: right;
        }

       .hero  .msg-row.bot .msg-time {
            text-align: left;
        }

        /* System message */
       .hero  .sys-msg {
            text-align: center;
            font-size: 11.5px;
            color: #666;
            background: #f5f8fa;
            padding: 6px 14px;
            border-radius: 20px;
            align-self: center;
        }

        /* Typing */
      .hero   .typing-bubble {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 12px 16px;
        }

       .hero  .typing-bubble span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #0074A3;
            opacity: .4;
            animation: blink 1.2s infinite;
        }

       .hero  .typing-bubble span:nth-child(2) {
            animation-delay: .2s;
        }

       .hero  .typing-bubble span:nth-child(3) {
            animation-delay: .4s;
        }

        @keyframes blink {

            0%,
            80%,
            100% {
                opacity: .15;
            }

            40% {
                opacity: .85;
            }
        }

        /* Quick replies */
      .hero   .quick-replies {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 0 16px 10px;
        }

      .hero   .quick-btn {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            background: #fff;
            color: #0074A3;
            border: 1.5px solid #0074A3;
            cursor: pointer;
            transition: all .15s;
            white-space: nowrap;
        }

       .hero  .quick-btn:hover {
            background: #0074A3;
            color: #fff;
        }

        /* Input area */
       .hero  .chat-input {
            padding: 12px 14px;
            border-top: 1px solid #edf2f7;
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
        }

       .hero  .chat-input input {
            flex: 1;
            padding: 9px 14px;
            border-radius: 24px;
            font-size: 13.5px;
            background: #f0f4f8;
            border: 1.5px solid transparent;
            transition: border .2s;
            font-family: inherit;
        }

       .hero  .chat-input input:focus {
            border-color: #0074A3;
            background: #fff;
            outline: none;
        }

       .hero  .chat-input button {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #0074A3;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: transform .15s, background .15s;
        }

       .hero  .chat-input button:hover {
            transform: scale(1.07);
            background: #005f88;
        }

       .hero  .chat-input button i {
            color: #fff;
            font-size: 14px;
        }

        /* Footer note */
       .hero  .chat-footer {
            text-align: center;
            font-size: 10.5px;
            color: #666;
            padding: 6px 0 10px;
        }

       .hero  .chat-footer span {
            color: #272343;
        }
        @media screen and (max-width:1400px){
            .hero #chatBox {
            width: 360px;
            }
            .hero #chatToggle {
            width: 45px;
            height: 45px;
            }
        }
        @media screen and (max-width:1199px){
            .hero h1 {
            width: 100%;
            }
            .hero .saas p {
           width: 100%;
            }
            .hero #chatToggle {
            right: 102%;
                
            }
            .hero .instant {
            font-size: 14px;
            line-height: 20px;
                
            }
            .hero .pill {
            font-size: 12px;
            line-height: 18px;
                
            }
            .hero .kicker{
                padding: 6px 5px;
            }
        }
         @media screen and (max-width:991px){
             .hero {
                padding: 50px 0px
             }
             .hero .row{
                 row-gap:20px;
             }
            .hero .saas {
            align-items: center;
            justify-content: center;
            gap:12px;
                        
            } 
            .hero .saas p,
            .hero h1 {
                text-align: center;
            }
            .hero .parentbox {
            display: flex;
            align-items: center;
            justify-content: center;
            }
            .hero #chatToggle {
            right: 20%;
            }
            .hero .blur1 {
             display: none;
            }
              }
              @media screen and (max-width: 767px) {
                .hero {
                        padding: 30px 0px;
                    }
                                .hero .kicker {
                    flex-direction: column;
                }
                .hero #chatToggle {
                    right: 0%;
                }
                .hero .kicker {
                    background:transparent;
                }
                .hero .blurry {
                    width: 100%;
                    height: 200px;
                    
                }
                .hero .blur2 {
                left: 0%;
                }
                .hero h1 {
                font-size: 30px;
                line-height: 36px;
                    
                }
                .hero #chatBox {
                    width: 100%;
                    max-width: 360px;
                }
            }
              @media screen and (max-width: 480px) {
                .hero .parentbox {
                    justify-content: start;
                }
                .hero .chat-header .avatar {
                    width: 30px;
                    height: 30px;
                    font-size: 12px;
                }
                .hero .chat-header .info .support {
                    font-size: 10px;
                    line-height: 16px;
                }
                .hero .chat-header .info span {
                    font-size: 10px;
                    display: flex;
                    align-items: center;
                }
                .hero .chat-header .info {
                    display: flex;
                    flex-direction: column;
                }
                .hero .chat-header .status-dot {
                    width: 4px;
                    height: 4px;
                }
                .hero .sys-msg {
                    text-align: center;
                    font-size: 8px;
                }
                .hero .bubble {
                    padding: 8px 10px;
                    border-radius: 16px;
                    font-size: 10px;
                    line-height: 16px;
                }
                .hero .quick-btn {
                    padding: 4px 8px;
                    border-radius: 20px;
                    font-size: 10px;
                }
                .hero .msg-avatar {
                    width: 20px;
                    height: 20px;
                }
                .hero .chat-input input {
                    font-size:10px;
                }
                .hero #chatToggle {
                    width: 35px;
                    height: 35px;
                    font-size: 10px;
                    bottom: 0px;
                }
                .hero .ctaRow .btn1, .hero .ctaRow .btn2 {
                    padding: 8px 15px;
                    font-size: 12px;
                    line-height:18px;
                }
                .hero .feature_list li,
                .hero .saas p {
                    font-size: 14px;
                    line-height: 20px;
                    
                }
                .hero .instant {
                    display: none;
            }
            }

    </style>
    <style>
     .explanatory {
         padding:50px 0px;
     }
      .explanatory .row{
          row-gap:20px;
      }
        .explanatory .content{
            width:60%;
            margin:auto;
            text-align:center;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:15px;
            padding-bottom:30px;
        }
         .explanatory .ai_box{
             height:100%;
             background:#ffffff;
             padding:30px 50px;
             border-radius:10px;
             box-shadow: 0px 23.33px 46.67px -15.56px #0A0D121F;
             display:flex;
             flex-direction:column;
             align-items:center;
             justify-content:center;
             text-align:center;
             gap:10px;
             border: 3px solid #fff;
             transition: all 0.3s ease-in;
         }
         .explanatory .ai_box:hover{
             border-color: #00A9DA26;
             cursor:pointer;
         }
         .explanatory .ai_box:hover .icon{
             background:#00A9DA26;
             color:#272343;
         }
           .explanatory .icon{
             width:45px;
             height:45px;
             font-size:16px;
             border-radius:50%;
             color:#fff;
             background:#0074A3;
             border: 5px solid #00A9DA26;
             display:flex;
             flex-direction:column;
             align-items:center;
             justify-content:center; 
             transition: all 0.3s ease-in;
           }
           .explanatory h2{
               font-size:40px;
               line-height:46px;
               font-weight:700;
               color:#272343;
           }
           .explanatory p{
               font-size:16px;
               line-height:22px;
               font-weight:400;
               color:#666666;
           }
           .explanatory .title{
               font-size:20px;
               line-height:26px;
               font-weight:700;
               color:#272343;
           }
            @media screen and (max-width:991px){
                .explanatory .content {
                width: 100%;
                }
            .explanatory .ai_box {
                padding: 20px 20px;    
            }
            }
            @media screen and (max-width:767px){
                .explanatory {
                    padding: 30px 0px;
                }
                
            .explanatory h2 {
                font-size: 30px;
                line-height: 36px;    
            }
                .explanatory p {
                font-size: 12px;
                line-height: 18px;
                    
                }
                .explanatory .title {
                font-size: 16px;
                line-height: 22px;
                    
                }
            }
            @media screen and (max-width:480px){
                .explanatory .ai_box {
                padding: 10px 10px;
                gap:5px;
            }
                .explanatory .ai_box p {
                font-size: 10px;
                line-height: 16px;
            }
            .explanatory .icon {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }
            }
    </style>
    <style>
        .wow_it_works {
          padding: 50px 0;
        }
        .wow_it_works .how-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .wow_it_works .how-grid {
          width:90%;
          margin: auto;
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 20px;
          align-items: center;
        }
        
        .wow_it_works .how-image img {
          width: 100%;
          border-radius: 25px;
          object-fit: cover;
        }
        
        .wow_it_works .how-content h2 {
          font-size: 40px;
          line-height:46px;
          font-weight: 700;
          color:#272343;
        }
         .wow_it_works h3 {
          font-size: 24px;
          line-height:30px;
          font-weight: 600;
          color:#272343;
        }
        .wow_it_works p{
            font-size: 16px;
          line-height:22px;
          color: #666;
        }
        
        .wow_it_works .step-box {
          display: flex;
          gap: 20px;
          padding: 20px;
          border: 1px solid #eee;
          border-radius: 15px;
          background: #fff;
          transition: 0.3s ease;
        }
        
        .wow_it_works .step-box:hover {
          box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }
        
        .wow_it_works .step-num {
          min-width: 45px;
          height: 45px;
          background: #ff8c1a;
          color: #fff;
          font-weight: 600;
          display: flex;
          align-items: center;
          justify-content: center;
          border-radius: 50%;
        }
            
        .wow_it_works .swiper-button-next::after,
        .wow_it_works .swiper-button-prev::after {
          display: none;
        }
        .wow_it_works .swiper-button-next,
        .wow_it_works .swiper-button-prev {
          width: 35px;
          height: 35px;
          background: #E2E2E2;
          border-radius: 50%;
          box-shadow: 0 8px 25px rgba(0,0,0,0.08);
          display: flex;
          align-items: center;
          justify-content: center;
          color: #272343;
          transition: 0.3s ease;
        }
        
        .wow_it_works .swiper-button-next:hover,
        .wow_it_works .swiper-button-prev:hover {
          background: #0074A3;
          color: #fff;
        }

        .wow_it_works .swiper-pagination-bullet-active {
          background: #0074A3;
        width: 20px;
        background: #0074A3;
        height: 10px;
        border-radius: 5px;
        }
            .wow_it_works .swiper-pagination {
              display: flex;
              justify-content: center;
              align-items: center;
              gap: 12px;
            }

            .wow_it_works .swiper-pagination-bullet::before {
              content: "";
              width: 10px;
              height: 10px;
              background: #ccc;
              border-radius: 50%;
              transition: 0.3s ease;
            }
            
            .wow_it_works .swiper-pagination-bullet-active::before {
              width: 20px;
              height: 10px;
              border-radius: 5px;
              background: #0074A3;
            }

        .wow_it_works .howSwiper{
            padding-bottom:50px;
        }
        
        @media screen and (max-width: 991px) {
            .wow_it_works {
                    padding: 30px 0;
                }
            .wow_it_works .swiper-button-next, .wow_it_works .swiper-button-prev {
                display: none !important;
            }
            .wow_it_works .step-box {
                    gap: 10px;
                    padding: 10px;
                
            }
            .wow_it_works .how-grid {
                width: 100%;
            }
            .wow_it_works .how-content h2 {
                font-size: 30px;
                line-height: 36px;
                }
            .wow_it_works p {
                font-size: 14px;
                line-height: 20px;
            }
            .wow_it_works h3 {
                font-size: 18px;
                line-height: 24px;
                
            }
        }
            @media screen and (max-width: 767px) {
                   .wow_it_works {
                    padding: 0px 0px 30px;
                }
                .wow_it_works .how-image{
                    display:none;
                }
          .wow_it_works .how-grid {
            grid-template-columns: 1fr;
          }
        }

    </style>
    <style>
    .pricing {
        padding: 0px 0px 70px;
        width: 100%;
    }
    .pricing .content {
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
        gap:12px;
        padding-bottom:50px;
    }
    .pricing .content h2 {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
    }

    .pricing .content p {
        color: #64748b;
        font-size: 14px;
    }

    .pricing .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .pricing .box_wrapper {
        position: relative;
    }

  .pricing .box_wrapper .card {
    background:#FBFBFB;
    );
    display: flex;
    flex-direction: column;
    gap: 12px;
}



    .pricing .box_wrapper:nth-child(1) .card {
        width: 300px;
        z-index: 1;
        border-radius: 16px 0 0 16px;
        padding: 32px 28px;
        box-shadow: -4px 0 20px rgba(0, 0, 0, 0.06), 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .pricing .box_wrapper:nth-child(3) .card {
        width: 300px;
        z-index: 1;
        border-radius: 0 16px 16px 0;
        padding: 32px 28px;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.06), 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .pricing  .box_wrapper:nth-child(2) {
        z-index: 3;
        margin-top: -28px;
        margin-bottom: -28px;
    }

    .pricing  .box_wrapper:nth-child(2) .card {
        width: 350px;
        border-radius: 16px;
        border: 2px solid #0074A3;
        box-shadow: 0 12px 48px rgba(28, 111, 168, 0.22);
        padding: 0 28px 32px 28px;
    }

    .pricing .box_wrapper:nth-child(2) .card .badge {
        display: block;
        background: #0074A3;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        padding: 11px 0;
        text-align: center;
        letter-spacing: 0.03em;
        margin-left: -28px;
        margin-right: -28px;
        border-radius: 14px 14px 0 0;
    }
    .pricing .price{
        text-align:center;
    }
    .pricing .card h3 {
        font-size: 18px;
        font-weight: 600;
        color: #272343;
        text-align:center;
    }

    .pricing .box_wrapper .card .price h4 {
        font-size: 44px;
        font-weight: 700;
        color: #272343;
        line-height: 50px;
        text-align:center;
    }

    .pricing .box_wrapper .card .price h4 sub {
        font-size: 16px;
        font-weight: 600;
        color: #666;
    }

    .pricing  .box_wrapper .card ul {
        display: flex;
        flex-direction: column;
        border-top: 1px solid #666;
        gap: 10px;
        margin:0px;
        padding: 15px 0px;
    }

    .pricing .box_wrapper .card ul li {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 14px;
        color: #666;
    }

    .pricing .box_wrapper .card ul li i {
        color: #f38521;
        font-size: 12px;
    }

    .pricing .box_wrapper .card .btn {
        display: block;
        width: 100%;
        padding: 11px 0;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: 1.5px solid #0074A3;
        background: transparent;
        color: #0074A3;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pricing .box_wrapper .card .btn:hover {
        background: #0074A3;
        color: #fff;
    }

    .pricing .box_wrapper:nth-child(2) .card .btn {
        background: #0074A3;
        color: #ffffff;
        border-color: #0074A3;
    }
    
    .pricing .box_wrapper:nth-child(2) .card .btn:hover {
        background: transparent;
        color: #0074A3;
        border-color: #0074A3;
    }
@media screen and (max-width:991px){
    .pricing .box_wrapper:nth-child(3) .card,
    .pricing .box_wrapper:nth-child(1) .card {
    width: 225px;
    padding: 20px 20px;
    }
    .pricing .box_wrapper:nth-child(2) .card{
    width: 280px;
    padding: 0px 20px 20px 20px; 
    }
    .pricing .box_wrapper:nth-child(2) .card .badge {
    margin-left: -20px;
    margin-right: -20px;
    }
}
@media screen and (max-width:767px){
    .pricing .wrapper {
    flex-direction: column;
    gap: 20px;
}
.pricing .content{
    padding-bottom: 20px;
}
.pricing .box_wrapper:nth-child(2) {
     margin-top: 0px; 
     margin-bottom: 0px; 
}
.pricing .box_wrapper:nth-child(3) .card,
    .pricing .box_wrapper:nth-child(1) .card {
    width: 280px;
    border-radius: 16px 16px 16px 16px;
    }
    .pricing {
    padding: 0px 0px 30px;
    }
    
}
</style>
    <style>
        .portals {
                padding: 0px 0px 50px;
            }
    
        .portals .content {
            text-align: center;
            margin-bottom: 40px;
        }
    
        .portals .content h2 {
            font-size: 40px;
            line-height:46px;
            font-weight: 800;
            color: #272343;
        }
    
        .portals .content p {
            font-size: 14px;
            color: #64748b;
        }
    
        .portals .portal_card {
            padding:14px;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    
        .portals .portal_card figure {
            width: 100%;
            height: 200px;
            overflow: hidden;
            border-radius:16px;
        }
    
        .portals .portal_card figure img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    
        .portals .portal_card h3 {
            font-size: 17px;
            line-height: 23px;
            font-weight: 600;
            color: #0f172a;
        }
    
        .portals .portal_card p {
            font-size: 13px;
            color: #4b5563;
            line-height: 19px;
        }
    
        .portals .portal_card .btns {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    
        .portals .portal_card .btns a {
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
    
        .portals .portal_card .btns a:first-child {
            background: #0074A3;
            color: #ffffff;
            border: 1.5px solid #0074A3;
        }
    
        .portals .portal_card .btns a:first-child:hover {
            background: transparent;
            border-color: #cbd5e1;
            color:#0f172a;
        }
    
        .portals .portal_card .btns a:last-child {
            background: transparent;
            color: #0f172a;
            border: 1.5px solid #cbd5e1;
        }
    
        .portals .portal_card .btns a:last-child:hover {
            background: #0074A3;
            border-color: #0074A3;
            color: #ffffff;
        }
    
        @media screen and (max-width: 1199px) {
            .portals .portal_card .btns{
                flex-direction:column;
            }
            .portals .portal_card .btns a {
                width: 100%;
                text-align: center;
            }
            .portals .content {
                margin-bottom: 20px;
            }
        }
            @media screen and (max-width: 991px) {
                .portals .content h2 {
                font-size: 30px;
                line-height:36px;
                    
                }
            .portals {
                padding: 0px 0px 30px;
            }
            .portals .portal_card figure {
                height: 160px;
            }
                
            }
              @media screen and (max-width: 767px) {
            .portals .portal_card figure {
                height: 200px;
            }
                
            }
    </style>
    <style>
        .testimonials {
            overflow: hidden;
        }
        
        .testimonials .tes_header {
            width: 60%;
            margin: auto;
            text-align: center;
            margin-bottom: 50px;
            display:flex;
            flex-direction:column;
            gap:12px;
        }
        
        .testimonials .tes_header h2 {
            font-size: 40px;
            font-weight: 700;
            color: #272343;
            line-height: 46px;
        }
        
        .testimonials .tes_header p {
            color: #666;
            font-size: 16px;
            line-height: 22px;
        }
        
        .testimonials .marquee-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .testimonials .marquee-row {
            display: flex;
            width: 100%;
            overflow: hidden;
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);
            mask-image: linear-gradient(to right, transparent 0%, black 6%, black 94%, transparent 100%);
        }
        
        .testimonials .marquee-track {
            display: flex;
            gap: 20px;
            will-change: transform;
        }
        
        .testimonials .marquee-row:hover .marquee-track {
            animation-play-state: paused;
        }
        
        .testimonials .row-ltr .marquee-track {
            animation: scrollLeft 38s linear infinite;
        }
        
        .testimonials .row-rtl .marquee-track {
            animation: scrollRight 42s linear infinite;
        }
        
        .testimonials .track-slow {
            animation-duration: 33s;
        }
        
        @keyframes scrollLeft {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        
        @keyframes scrollRight {
            0% {
                transform: translateX(-50%);
            }
            100% {
                transform: translateX(0);
            }
        }
        
        .testimonials .testimonial-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 22px 22px 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            display: flex;
            flex-direction: column;
            gap: 12px;
            min-width: 300px;
            max-width: 300px;
            flex-shrink: 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }
        
        .testimonials .testimonial-card:hover {
            box-shadow: 0 12px 36px rgba(0,0,0,0.13);
        }
        
        .testimonials .card-top {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        
        .testimonials .card-top img {
            width: 49px;
            height: 49px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.12);
        
        }
        
        .testimonials .card-top .info h3 {
            font-size: 16px;
            font-weight: 500;
            color: #272343;
            margin-bottom: 4px;
        }
        
        .testimonials .stars {
            color: #FF8D28;
            font-size: 12px;
            letter-spacing: 1px;
        }
        
        .testimonials .card-text {
            font-size: 14px;
            color: #666;
            line-height: 20px;
        }
        @media screen and (max-width: 991px) {
        .testimonials .tes_header{
        width:80%;
        margin-bottom: 30px;
        }
        .testimonials .section-header {
        margin-bottom: 36px;
        padding: 0 16px;
        }
        
        .testimonials .tes_header h2 {
        font-size: 30px;
        line-height:36px;
        }
        
        .testimonials .section-header p {
        font-size: 14px;
        line-height:20px;
        }
        
        .testimonials .marquee-wrapper {
        gap: 16px;
        }
        
        .testimonials .testimonial-card {
        min-width: 260px;
        max-width: 260px;
        padding: 18px 18px 16px;
        }
        
        .testimonials .card-top img {
        width: 48px;
        height: 48px;
        }
        
        .testimonials .card-top .info h3 {
        font-size: 14px;
        line-height:20px;
        }
        
        .testimonials .card-text {
        font-size: 12px;
        line-height:18px;
        }
        }
        
        @media screen and (max-width: 767px) {
        
        .testimonials .tes_header {
        width:100%;
        margin-bottom: 28px;
        }
        
        .testimonials .tes_header p {
        font-size: 14px;
        line-height:20px;
        }
        
        .testimonials .marquee-wrapper {
        gap: 12px;
        }
        
        .testimonials .testimonial-card {
        min-width: 220px;
        max-width: 220px;
        padding: 14px 14px 12px;
        border-radius: 14px;
        gap: 10px;
        }
        
        .testimonials .card-top {
        gap: 10px;
        }
        
        .testimonials .card-top img {
        width: 42px;
        height: 42px;
        }
        
        .testimonials .card-top .info h3 {
        font-size: 14px;
        line-height:20px;
        margin-bottom: 3px;
        }
        
        .testimonials .stars {
        font-size: 10px;
        }
        
        .testimonials .card-text {
        font-size: 12px;
        line-height:18px;
        }
        
        .testimonials .marquee-row:nth-child(3) {
        display: none;
        }
        }
    </style>
    <style>
    .faqs {
        padding: 50px 0px;
    }
    
    .faqs .section-header {
        width:80%;
        margin:auto;
        text-align: center;
        margin-bottom: 50px;
    }
    
    .faqs .section-header h2 {
        font-size: 40px;
        font-weight: 700;
        color: #272343;
        line-height: 46px;
        margin-bottom: 16px;
    }
    
    .faqs .section-header p {
        font-size: 16px;
        line-height: 22px;
        color: #666;
    }
    
    .faqs .faq-wrapper {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    .faqs .faq-item {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        transition: box-shadow 0.25s ease;
    }
    
    .faqs .faq-item.open {
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    }
    
    .faqs .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 22px 24px;
        cursor: pointer;
        user-select: none;
        background: transparent;
        border: none;
        width: 100%;
        text-align: left;
    }
    
    .faqs .faq-question span {
        font-size: 16px;
        font-weight: 700;
        line-height: 22px;
        color: #1a1f36;
        flex: 1;
    }
    
    .faqs .faq-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: #1a1f36;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 15px;
        transition: background 0.25s ease;
    }
    
    .faqs .faq-item.open .faq-icon {
        background: #1e7fa6;
    }
    
    .faqs .faq-icon .fa-plus {
        display: block;
    }
    
    .faqs .faq-icon .fa-minus {
        display: none;
    }
    
    .faqs .faq-item.open .faq-icon .fa-plus {
        display: none;
    }
    
    .faqs .faq-item.open .faq-icon .fa-minus {
        display: block;
    }
    
    .faqs .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.35s ease;
        padding: 0 24px;
    }
    
    .faqs .faq-item.open .faq-answer {
        max-height: 300px;
        padding: 0 24px 22px;
    }
    
    .faqs .faq-answer p {
        font-size: 14px;
        line-height: 24px;
        color: #6b7280;
    }
    
    @media screen and (max-width: 991px) {
    .faqs {
    padding: 55px 0 65px;
    }
    .faqs .section-header {
    width: 100%;
    margin-bottom: 30px;
    }
    
    .faqs .section-header h2 {
    font-size: 30px;
    line-height:36px;
    }
    
    .faqs .section-header p {
    font-size: 14px;
    line-height: 20px;
    padding: 0 12px;
    }
    
    .faqs .faq-wrapper {
    gap: 12px;
    }
    }
    
    @media screen and (max-width: 767px) {
    .faqs {
    padding: 30px 0px;
    }
    
    .faqs .section-header h2 {
    font-size: 24px;
    line-height: 30px;
    }
    
    .faqs .section-header p {
    font-size: 14px;
    line-height: 20px;
    }
    
    .faqs .faq-question span {
    font-size: 14px;
    line-height: 20px;
    }
    
    .faqs .faq-answer p {
    font-size: 12px;
    line-height: 18px;
    }
    
    .faqs .faq-icon {
    width: 32px;
    height: 32px;
    font-size: 12px;
    }
    }
</style>
    <style>
    @media screen and (max-width:767px){
    .explanatory,
    .wow_it_works,
    .pricing,
    .portals,
    .testimonials,
    .faqs,
    .cta_section,
    .footer{
        display:none;
    }
    }
    </style>
    <style>
    .cta_section {
        padding: 50px 0px;
        background-color: #0074A3;
    }

    .cta_section .content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .cta_section .content h2 {
        color: #fff;
        font-size: 40px;
        line-height: 46px;
        font-weight: 700;
        text-align: center;
    }

    .cta_section .content p {
        color: #fff;
        font-size: 18px;
        line-height: 28px;
        font-weight: 400;
        max-width: 600px;
        text-align: center;
    }

    .cta_section .content .cta_btns {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .cta_section .content .cta_btns .btn1 {
        padding: 15px 30px;
        background-color: #fff;
        border: 2px solid #fff;
        color: #272343;
        font-size: 16px;
        line-height: 24px;
        font-weight: 500;
        border-radius: 50px;
        text-decoration: none;
    }

    .cta_section .content .cta_btns .btn2 {
        padding: 15px 30px;
        background-color: transparent;
        color: #fff;
        font-size: 16px;
        line-height: 24px;
        font-weight: 500;
        border-radius: 50px;
        border: 2px solid #fff;
        text-decoration: none;
    }
    .cta_section .content .cta_btns .btn1:hover {
      background-color: transparent; 
      color:#fff;
    }
     .cta_section .content .cta_btns .btn2:hover {
       background-color: #fff;  
       color:#272343;
     }
     @media screen and (max-width:991px){
     .cta_section .content h2 {
        font-size: 30px;
        line-height: 36px;
     }
     .cta_section .content p {
        font-size: 16px;
        line-height: 24px;
     }
         .cta_section .content .cta_btns .btn1,
         .cta_section .content .cta_btns .btn2 {
            padding: 10px 20px;
         }
     .cta_section {
        padding: 30px 0px;
        }
     }
     @media screen and (max-width:420px){
       .cta_section .content .cta_btns {
           width: 100%;
           flex-direction:column;
       } 
       .cta_section .content .cta_btns .btn1,
       .cta_section .content .cta_btns .btn2 {
            width: 100%;
            text-align: center;
        }
        .cta_section .content {
            gap:14px;
        }
     }
</style>
    <style>
    footer .topLine {
        margin: 50px 0px;
    }
    
    footer hr {
        opacity: .4;
        width: 100%;
        height: 1px;
        color: #666;
        background: #666;
        margin: 20px 0
    }
    
    footer .Part_A {
        display: flex;
        flex-direction: column;
        gap: 20px
    }
    
    footer .eze-logo {
        width: 191px;
        aspect-ratio: 191 / 50;
    }
    
    footer .F_Logo {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }
    
    footer .social {
        display: flex;
        align-items: center;
        gap: 20px
    }
    
    footer .social a i {
        color: #0074a3;
        width: 38px;
        height: 38px;
        font-size: 16px;
        border-radius: 50%;
        border: 1px solid #0074a3;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .3s ease-in
    }
    
    footer .social a i:hover {
        color: #fff;
        background: #0074a3
    }
    
    footer .Apps_Wrap {
        display: flex;
        align-items: center;
        gap: 20px
    }
    
    footer p {
        color: #666666;
        font-size: 16px;
        line-height: 22px;
        font-weight: 500
    }
    
    footer .footer_text {
        width: 100%;
        text-align: center;
        color: #272343;
        font-size: 16px;
        line-height: 22px;
        font-weight: 500;
        margin: auto;
        padding-bottom: 20px
    }
    
    footer .Apps_Wrap img {
        width: 120px;
        height: 40px;
        object-fit: cover
    }
    
    footer .Part_B {
        width: 98%;
        margin: auto;
        display: flex;
        justify-content: space-between
    }
    
    footer .Part_B .footer-menu h3 {
        font-size: 18px;
        line-height: 22px;
        color: #272343;
        font-weight: 700
    }
    
    footer .Part_B .footer-menu {
        display: flex;
        flex-direction: column;
        gap: 15px
    }
    
    footer .Part_B ul {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding:0px;
        margin:0px;
    }
    
    footer .Part_B a {
        color: #666666;
        font-size: 16px;
        line-height: 22px;
        font-weight: 500;
        transition: all .3s ease-in
    }
    
    footer .Part_B a:hover {
        color: #0074A3;
    }
    
    footer .Part_C {
        display: flex;
        flex-direction: column;
    }
    
    footer .Part_C label {
        font-size: 18px;
        line-height: 22px;
        color: #272343;
        font-weight: 700
    }
    
    footer .sub_email {
        display: flex;
        align-items: center;
        gap: 10px
    }
    
    footer form {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 15px
    }
    
    footer form button {
        background: #272343;
        border: 1px solid #272343;
        font-size: 16px;
        color: #fff;
        padding: 10px 10px;
        border-radius: 10px;
        transition: all .3s ease-in
    }
    
    footer form button:hover {
        background: #f38521;
        border: 1px solid #f38521
    }
    
    footer form input {
        border: 1px solid #e1e3e5;
        font-size: 16px;
        color: #272343;
        background: #fff0;
        padding: 10px 10px;
        outline: 0;
        border-radius: 10px
    }
    
    .back-to-top {
        position: fixed;
        bottom: 15px;
        right: 6px;
        z-index: 100000;
        display: none;
        width: 50px;
        height: 42px;
        background-color: #0074a3;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
        transition: opacity .4s ease-in-out, visibility .4s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center
    }
    
    .back-to-top:hover {
        border-color: #0074a3;
        box-shadow: 0 6px 18px rgba(0, 116, 163, .25), 0 0 12px rgba(0, 116, 163, .35)
    }
    
    .back-to-top:focus {
        background: #f38521;
        border-color: #f38521;
        box-shadow: 0 6px 18px rgba(243, 133, 33, .25), 0 0 12px rgba(243, 133, 33, .35)
    }
    
    .back-to-top i {
        font-size: 18px;
        animation: jump 2s infinite
    }
    
    @keyframes jump {
    
        0%,
        100% {
            transform: translateY(4px)
        }
    
        50% {
            transform: translateY(-6px)
        }
    }
    
    .back-to-top.show {
        display: block;
        opacity: 1;
        visibility: visible
    }
    
    .back-to-top.hide {
        opacity: 0;
        visibility: hidden
    }
    @media screen and (max-width: 1400px) {
     footer .Part_B {
         width: 96%;
     }

     footer .footer_text {
         width: 61%;
     }

     footer p {
         font-size: 14px;
         line-height: 20px;
     }

     footer .Part_B a {
         font-size: 14px;
         line-height: 20px;
     }
 }

 @media screen and (max-width: 1199px) {
     footer .Apps_Wrap img {
         width: 100px;
         height: 35px;
     }

     footer .footer_app {
         border-radius: 10px;
         overflow: hidden;
     }

     footer .Part_B .footer-menu {
         width: 30%;
     }

     footer .footer_text {
         width: 76%;
     }
 }

 @media screen and (max-width: 991px) {
     footer figure {
         width: 200px;
     }

     footer .row {
         row-gap: 30px;
     }

     footer .Part_B .footer-menu {
         width: 26%;
     }

     footer .footer_text {
         width: 100%;
     }
 }

 @media screen and (max-width: 767px) {
     footer figure {
         width: 150px;
     }

     footer .Part_A {
         gap: 15px;
         align-items: center;
         text-align: center;
         justify-content: center;
     }

     footer .Part_C p {
         text-align: center;
     }

     footer .Part_B {
         width: 100%;
     }

     footer .Part_C {
         gap: 8px;
     }

     footer .Part_B .footer-menu {
         width: 30%;
     }

     footer .Part_B .footer-menu h3 {
         font-size: 16px;
         line-height: 18px;
     }

     footer .Part_C label {
         font-size: 16px;
         line-height: 20px;
     }
 }

 @media screen and (max-width: 480px) {
     footer .Part_B a {
         font-size: 12px;
         line-height: 18px;
     }

     footer .Part_B ul {
         gap: 0px;
     }
 }

 @media screen and (max-width: 360px) {
     footer .Part_B {
         flex-wrap: wrap;
     }

     footer .Part_B .footer-menu {
         width: 33%;
     }

     footer p {
         font-size: 12px;
         line-height: 18px;
     }
 }

 @media screen and (max-width: 767px) {
     .back-to-top {
         width: 40px;
         height: 35px;
     }

     .back-to-top i {
         font-size: 16px;
     }
 }
    </style>
</head>

<body>
    <header class="light_header">
        <div class="container">
            <div class="light_nav">

                <!-- Logo -->
                <div class="light_brand">
                    <a href="/" class="light_logo">
                        <img src="https://eze.pics/ezead-chat-images/logo2.png" width="224" height="63"
                            loading="eager" alt="Logo" />
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="light_nav_links">
                    <a href="#features"><span class="dot" aria-hidden="true"></span>Features</a>
                    <a href="#pricing"><span class="dot" aria-hidden="true"></span> Pricing</a>
                    <a href="company/login"><span class="dot" aria-hidden="true"></span> Company Login</a>
                    <a href="/login"><span class="dot" aria-hidden="true"></span> Admin Login</a>
                    <a href="/agent/login"><span class="dot" aria-hidden="true"></span> Agent Login</a>
                    <a href="#get-started" class="light_btn_primary"><span class="dot" aria-hidden="true"></span>
                        Get Started</a>
                </nav>

                <!-- Mobile Toggle -->
                <button class="light_toggle" id="light_openSidebar" aria-label="Open Sidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>

            </div>
        </div>

        <!-- Sidebar -->
        <aside class="light_sidebar" id="light_sidebar">
            <div class="light_sidebar_top">
                <img src="https://eze.pics/ezead-chat-images/logo2.png" width="224" height="63"
                    loading="eager" alt="Logo" />
                <button id="light_closeSidebar" aria-label="Close Sidebar">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <nav class="light_sidebar_links">
                <a href="#features"><span class="dot" aria-hidden="true"></span> Features</a>
                <a href="#pricing"><span class="dot" aria-hidden="true"></span> Pricing</a>
                <a href="company/login"><span class="dot" aria-hidden="true"></span> Company Login</a>
                <a href="/admin/login"><span class="dot" aria-hidden="true"></span> Admin Login</a>
                <a href="/agent/login"><span class="dot" aria-hidden="true"></span> Agent Login</a>
                <a href="#get-started" class="light_btn_primary"><span class="dot" aria-hidden="true"></span> Get Started</a>
            </nav>
        </aside>

        <div class="light_overlay" id="light_overlay"></div>
    </header>
    <main id="LandMark">
        <section class="hero">
            <div class="blur1 blurry"></div>
             <div class="blur2 blurry"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="saas">
                            <div class="kicker">
                                <span class="pill"><i class="fa-solid fa-robot"></i> AI + Human Hybrid</span>
                                <span class="instant"><i class="fa-solid fa-circle"></i> Instant replies • Smart routing • Analytics • Automation</span>
                            </div>
                            <h1>AI-Powered SaaS Support Chat System</h1>
                            <p class="subhead">
                                Deliver lightning-fast customer support with an AI Agent that resolves FAQs, triages
                                requests,
                                and escalates to the right human agent automatically—while admins get full analytics and
                                control.
                            </p>
                            <ul class="feature_list">
                              <li><i class="fa-solid fa-circle"></i> Real-time chat + conversation history</li>
                              <li><i class="fa-solid fa-circle"></i> AI Agent with knowledge-base answers</li>
                              <li><i class="fa-solid fa-circle"></i> Role-based access (Company / Admin / Agent)</li>
                            </ul>

                            <div class="ctaRow" id="get-started">
                                <a class="btn1" href="#roles" role="button" aria-label="Launch portals">
                                    <span>Launch Portals</span>
                                    <span aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span>
                                </a>
                                <button class="btn2" id="demoBtn" type="button">Run Interactive Demo</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                    <div class="parentbox">
                         <div class="blur3 blurry"></div>
                        <!-- ── Toggle Button ── -->
                        <button id="chatToggle" aria-label="Open chat">
                            <i class="fa-solid fa-comment-dots ico-open"></i>
                            <i class="fa-solid fa-xmark ico-close" style="display:none"></i>
                            <div class="notif">1</div>
                        </button>
                        <!-- ── Chat Window ── -->
                        <div id="chatBox">
                            <!-- Header -->
                            <div class="chat-header">
                                <div class="avatar">
                                  <i class="fa-solid fa-robot"></i>
                                </div>
                                <div class="info">
                                    <span class="support">EzeAD Support</span>
                                    <span><span class="status-dot"></span>Online · Avg reply &lt; 1 min</span>
                                </div>
                                <div class="mode-pills">
                                    <button class="mode-pill active" id="pillAI">AI</button>
                                    <button class="mode-pill" id="pillAgent">Agent</button>
                                </div>
                            </div>
                            <!-- Messages -->
                            <div class="chat-msgs" id="msgs"></div>
                            <!-- Quick replies -->
                            <div class="quick-replies" id="quickReplies">
                                <button class="quick-btn">💳 Billing</button>
                                <button class="quick-btn">🔑 Reset Password</button>
                                <button class="quick-btn">👥 Add Agent</button>
                                <button class="quick-btn">📊 Analytics</button>
                                <button class="quick-btn">🤖 Automations</button>
                            </div>
                    
                            <!-- Input -->
                            <div class="chat-input">
                                <input id="msgInput" type="text" placeholder="Type your message…" autocomplete="off" />
                                <button id="sendBtn" aria-label="Send message"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                            <div class="chat-footer">Powered by <span>EzeAD AI</span></div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="explanatory">
                <div class="container">
                    <div class="content">
                        <h2>
                            Everything you built, made self-explanatory
                        </h2>
                        <p>
                            A complete support platform: real-time chat, AI automation, role dashboards, secure access, and
                            data-driven optimization, wrapped in an interactive UI.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="ai_box">
                                <span class="icon">
                                    <i class="fa-solid fa-clock"></i>
                                </span>
                                <p class="title">Live Chat + History</p>
                                <p>
                                    Real-time messaging, transcripts, internal notes, tags, and customer timeline built for fast
                                    resolution.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="ai_box">
                                <span class="icon">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                                <p class="title">Enterprise Security</p>
                                <p>
                                    Role-based permissions, audit-friendly actions, and safe-by-default design for SaaS multi-tenant
                                    usage.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="ai_box">
                                <span class="icon">
                                    <i class="fa-solid fa-gear"></i>
                                </span>
                                <p class="title">AI Agent Layer</p>
                                <p>
                                    Instant answers, intent detection, knowledge-based responses, and smart escalation to human
                                    agents.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="ai_box">
                                <span class="icon">
                                    <i class="fa-solid fa-chart-column"></i>
                                </span>
                                <p class="title">Analytics Dashboard</p>
                                <p>
                                    Measure CSAT, response time, AI resolution rate, agent performance, and conversation trends.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="ai_box">
                                <span class="icon">
                                    <i class="fa-solid fa-diagram-project"></i>
                                </span>
                                <p class="title">Automation Workflows</p>
                                <p>
                                    Auto-assign, route by skill, trigger follow-ups, escalate rules, and integrate webhooks
                                    hands-free ops.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                            <div class="ai_box">
                                <span class="icon">
                                    <i class="fa-brands fa-battle-net"></i>
                                </span>
                                <p class="title">Multi-Channel Ready</p>
                                <p>
                                    Embed on websites, apps, portals, single unified inbox. Consistent branding + customizable
                                    widget.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <section class="wow_it_works">
          <div class="container">
            <div class="swiper howSwiper">
              <div class="swiper-wrapper">
                <!-- ===== Slide 1 ===== -->
                <div class="swiper-slide">
                  <div class="how-grid">
                    <div class="how-image">
                      <img src="images/how1.png" width="500" height="333" loading="lazy" alt="AI Chat">
                    </div>
                    <div class="how-content">
                      <h2>How It Works</h2>
                      <p class="sub">
                        From first message to resolution—AI handles the first layer,
                        humans handle the edge cases, and analytics improve everything.
                      </p>
                      <div class="step-box">
                        <span class="step-num">1</span>
                        <div>
                          <h3>Customer Initiates Chat</h3>
                          <p>Widget loads instantly on your site/app. Conversations start with minimal friction.</p>
                        </div>
                      </div>
                      <div class="step-box">
                        <span class="step-num">2</span>
                        <div>
                          <h3>AI Responds In Seconds</h3>
                          <p>AI answers FAQs, collects structured info, and detects intent + urgency.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ===== Slide 2 ===== -->
                <div class="swiper-slide">
                  <div class="how-grid">
                    <div class="how-image">
                      <img src="images/how2.png" width="500" height="333" loading="lazy" alt="Human Support">
                    </div>
                    <div class="how-content">
                      <h2>Smart Escalation</h2>
                      <p class="sub">
                        When automation reaches limits, conversations move smoothly to human agents.
                      </p>
                      <div class="step-box">
                        <span class="step-num">3</span>
                        <div>
                          <h3>Seamless Handoff</h3>
                          <p>AI transfers chat with full context so customers never repeat themselves.</p>
                        </div>
                      </div>
                      <div class="step-box">
                        <span class="step-num">4</span>
                        <div>
                          <h3>Resolution & Insights</h3>
                          <p>Analytics capture insights to continuously improve support quality.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Navigation -->
              <!-- Navigation -->
                <div class="swiper-button-prev">
                  <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="swiper-button-next">
                  <i class="fa-solid fa-chevron-right"></i>
                </div>
              <!-- Pagination -->
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </section>
        <section class="pricing">
            <div class="container">
                <div class="content">
                    <h2>
                        Pricing
                    </h2>
                    <p>
                        Dummy pricing you can replace later. Structured for SaaS tiers (Starter → Pro → Enterprise).
                    </p>
                </div>
                <div class="wrapper">
                    <div class="box_wrapper">
                        <div class="card">
                            <h3>Starter</h3>
                            <div class="price">
                                <h4>$29<sub>/Month</sub>
                                </h4>
                            </div>
                            <ul>
                                <li><i class="fa-solid fa-check"></i>1 admin workspace</li>
                                <li><i class="fa-solid fa-check"></i>Up to 3 agents</li>
                                <li><i class="fa-solid fa-check"></i>Basic AI replies</li>
                            </ul>
                            <a href="#" class="btn">Get Started</a>
                        </div>
                    </div>
                    <div class="box_wrapper">
                        <div class="card">
                            <div class="badge">Most popular ✦</div>
                            <h3>Pro</h3>
                            <div class="price">
                                <h4>$79<sub>/Month</sub>
                                </h4>
                            </div>
                            <ul>
                                <li><i class="fa-solid fa-check"></i>Multiple teams / inboxes</li>
                                <li><i class="fa-solid fa-check"></i>Up to 15 agents</li>
                                <li><i class="fa-solid fa-check"></i>Advanced AI training</li>
                                <li><i class="fa-solid fa-check"></i>Automation workflows</li>
                                <li><i class="fa-solid fa-check"></i>Priority support</li>
                            </ul>
                            <a href="#" class="btn">Get Started</a>
                        </div>
                    </div>
                    <div class="box_wrapper">
                        <div class="card">
                            <h3>Enterprise</h3>
                            <div class="price">
                                <h4>$199<sub>/Month</sub>
                                </h4>
                            </div>
                            <ul>
                                <li><i class="fa-solid fa-check"></i>Unlimited agents</li>
                                <li><i class="fa-solid fa-check"></i>Dedicated infrastructure</li>
                                <li><i class="fa-solid fa-check"></i>Custom AI model + policies</li>
                            </ul>
                            <a href="#" class="btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="portals">
        <div class="container">
            <div class="content">
                <h2>Portals</h2>
                <p>Three entry points (as you requested): Company portal, Admin console, and Agent desk.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="portal_card">
                        <figure>
                            <img src="images/portal1.webp"
                                alt="company image" loading="lazy">
                        </figure>
                        <h3>Company</h3>
                        <p>
                            Manage organization profile, channels, team structure, branding, billing, and support policies.
                        </p>
                        <div class="btns">
                            <a href="#">Open Company Portal <i class="fa-solid fa-arrow-right"></i></a>
                            <a href="#">View Features <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="portal_card">
                        <figure>
                            <img src="images/portal2.webp"
                                alt="admin image" loading="lazy">
                        </figure>
                        <h3>Admin</h3>
                        <p>
                            Configure AI knowledge, routing rules, automation workflows, analytics, and compliance settings.
                        </p>
                        <div class="btns">
                            <a href="#">Open Admin Console <i class="fa-solid fa-arrow-right"></i></a>
                            <a href="#">See Process <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="portal_card">
                        <figure>
                            <img src="images/portal3.webp"
                                alt="agent image" loading="lazy">
                        </figure>
                        <h3>Agent</h3>
                        <p>
                            Manage organization profile, channels, team structure, branding, billing, and support policies.
                        </p>
                        <div class="btns">
                            <a href="#">Open Agent Desk<i class="fa-solid fa-arrow-right"></i></a>
                            <a href="#">Try Agent Model <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="testimonials">
            <div class="container">
                <div class="tes_header">
                    <h2>What people are saying about<br>Chatbot</h2>
                    <p>See why users love Chatbot, with over 100,000 reviews averaging 4.9 stars. Our chatbot delivers
                        satisfaction, reliability, and powerful assistance that users trust worldwide. Discover what makes
                        Chatbot a top choice in AI assistance!</p>
                </div>
            </div>
            <div class="marquee-wrapper">
                <div class="marquee-row row-ltr">
                    <div class="marquee-track">
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes1.png" width="49" height="49" loading="lazy"
                                    alt="Sarah K." />
                                <div class="info">
                                    <h3>Sarah K.</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of words
                                and phrases.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes2.png" width="49" height="49" loading="lazy"
                                    alt="John Doe" />
                                <div class="info">
                                    <h3>John Doe</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                phrases and data.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes3.png" width="49" height="49" loading="lazy"
                                    alt="Mira Thompson" />
                                <div class="info">
                                    <h3>Mira Thompson</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of data
                                entries.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes4.png" width="49" height="49" loading="lazy"
                                    alt="Robert Johnson" />
                                <div class="info">
                                    <h3>Robert Johnson</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                content types.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes5.png" width="49" height="49" loading="lazy"
                                    alt="Kim Jin" />
                                <div class="info">
                                    <h3>Kim Jin</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                options and more.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes1.png" width="49" height="49" loading="lazy"
                                    alt="Sarah K." />
                                <div class="info">
                                    <h3>Sarah K.</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of words
                                and phrases.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes2.png" width="49" height="49" loading="lazy"
                                    alt="John Doe" />
                                <div class="info">
                                    <h3>John Doe</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                phrases and data.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes3.png" width="49" height="49" loading="lazy"
                                    alt="Mira Thompson" />
                                <div class="info">
                                    <h3>Mira Thompson</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of data
                                entries.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes4.png" width="49" height="49" loading="lazy"
                                    alt="Robert Johnson" />
                                <div class="info">
                                    <h3>Robert Johnson</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                content types.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes5.png" width="49" height="49" loading="lazy"
                                    alt="Kim Jin" />
                                <div class="info">
                                    <h3>Kim Jin</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                options and more.</p>
                        </div>
                    </div>
                </div>
                <div class="marquee-row row-rtl">
                    <div class="marquee-track">
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes6.png" width="49" height="49" loading="lazy"
                                    alt="Nadia Abdullah" />
                                <div class="info">
                                    <h3>Nadia Abdullah</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                layouts and grids.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes7.png" width="49" height="49" loading="lazy"
                                    alt="Mike Miller" />
                                <div class="info">
                                    <h3>Mike Miller</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                templates.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes8.png" width="49" height="49" loading="lazy"
                                    alt="Deepika Sharma" />
                                <div class="info">
                                    <h3>Deepika Sharma</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                modules.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes6.png" width="49" height="49" loading="lazy"
                                    alt="Sofia Martinez" />
                                <div class="info">
                                    <h3>Sofia Martinez</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i
                                            class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                components.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes1.png" width="49" height="49" loading="lazy"
                                    alt="Alex Chen" />
                                <div class="info">
                                    <h3>Alex Chen</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                variables.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes6.png" width="49" height="49" loading="lazy"
                                    alt="Nadia Abdullah" />
                                <div class="info">
                                    <h3>Nadia Abdullah</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                layouts and grids.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes7.png" width="49" height="49" loading="lazy"
                                    alt="Mike Miller" />
                                <div class="info">
                                    <h3>Mike Miller</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                templates.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes8.png" width="49" height="49" loading="lazy"
                                    alt="Deepika Sharma" />
                                <div class="info">
                                    <h3>Deepika Sharma</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                modules.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes6.png" width="49" height="49" loading="lazy"
                                    alt="Sofia Martinez" />
                                <div class="info">
                                    <h3>Sofia Martinez</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i
                                            class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                components.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes1.png" width="49" height="49" loading="lazy"
                                    alt="Alex Chen" />
                                <div class="info">
                                    <h3>Alex Chen</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                variables.</p>
                        </div>
                    </div>
                </div>
                <div class="marquee-row row-ltr row-slow">
                    <div class="marquee-track track-slow">
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes2.png" width="49" height="49"
                                    loading="lazy" alt="Priya Patel" />
                                <div class="info">
                                    <h3>Priya Patel</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                elements.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes3.png" width="49" height="49"
                                    loading="lazy" alt="Lucas Brown" />
                                <div class="info">
                                    <h3>Lucas Brown</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of text
                                blocks.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes4.png" width="49" height="49"
                                    loading="lazy" alt="Amina Hassan" />
                                <div class="info">
                                    <h3>Amina Hassan</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                patterns.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes5.png" width="49" height="49"
                                    loading="lazy" alt="Tom Wilson" />
                                <div class="info">
                                    <h3>Tom Wilson</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                styles.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes6.png" width="49" height="49"
                                    loading="lazy" alt="Yuki Tanaka" />
                                <div class="info">
                                    <h3>Yuki Tanaka</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                themes.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes2.png" width="49" height="49"
                                    loading="lazy" alt="Priya Patel" />
                                <div class="info">
                                    <h3>Priya Patel</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                elements.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes3.png" width="49" height="49"
                                    loading="lazy" alt="Lucas Brown" />
                                <div class="info">
                                    <h3>Lucas Brown</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of text
                                blocks.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes4.png" width="49" height="49"
                                    loading="lazy" alt="Amina Hassan" />
                                <div class="info">
                                    <h3>Amina Hassan</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                patterns.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes5.png" width="49" height="49"
                                    loading="lazy" alt="Tom Wilson" />
                                <div class="info">
                                    <h3>Tom Wilson</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-regular fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                styles.</p>
                        </div>
                        <div class="testimonial-card">
                            <div class="card-top"><img src="images/tes6.png" width="49" height="49"
                                    loading="lazy" alt="Yuki Tanaka" />
                                <div class="info">
                                    <h3>Yuki Tanaka</h3>
                                    <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                            class="fa-solid fa-star"></i></div>
                                </div>
                            </div>
                            <p class="card-text">Free tool that generates dummy text containing a customizable set of
                                themes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="faqs">
        <div class="container">
            <div class="section-header">
                <h2>Have Questions?</h2>
                <p>Our FAQ section covers everything you need to know about Chatbot, from setup and customization to
                    troubleshooting and support. Find quick, helpful answers to make integrating Chatbot into your
                    website seamless and hassle-free.</p>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="faq-wrapper">
                        <div class="faq-item open">
                            <button class="faq-question" aria-expanded="true">
                                <span>How do I get started with Chatbot?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Simply download the app from Google Play or the App Store, follow the setup guide,
                                    and start using Chatbot instantly.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Is Chatbot available in multiple languages?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Absolutely. Chatbot supports over 50 languages, enabling you to serve a global
                                    audience without any additional configuration.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Can AI cancel my subscription?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>No. Only account administrators can manage or cancel subscriptions. All billing
                                    actions require human authorization through your account settings.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Is my data secure with Chatbot?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Yes. We use end-to-end encryption and comply with GDPR, HIPAA, and SOC 2 standards to
                                    ensure your data remains private and secure.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>How does Chatbot integrate with my website?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Integration is simple — just paste a single line of JavaScript into your website's
                                    HTML, and Chatbot will appear as a widget automatically.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Can I try Chatbot before purchasing?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Of course! We offer a 14-day free trial with full access to all features. No credit
                                    card required to get started.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="faq-wrapper">
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Can I customize Chatbot's responses to fit my needs?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Yes! You can train Chatbot with your own data, set custom tones, and define response
                                    rules to match your brand's voice perfectly.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>What types of tasks can Chatbot assist with?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Chatbot can handle customer support, lead generation, appointment booking, FAQs,
                                    product recommendations, and much more.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>What kind of support is available if I encounter issues?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>We offer 24/7 live chat support, a detailed knowledge base, email support, and
                                    dedicated account managers for enterprise plans.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Can Chatbot generate images?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Yes, with our Pro plan Chatbot can generate images using AI. Simply describe what you
                                    need and it will create visuals instantly.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>Does Chatbot work with third-party platforms?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>Yes! Chatbot integrates with Slack, HubSpot, Zapier, Shopify, WordPress, and dozens
                                    of other popular platforms out of the box.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" aria-expanded="false">
                                <span>How often is Chatbot updated with new features?</span>
                                <div class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                    <i class="fa-solid fa-minus"></i>
                                </div>
                            </button>
                            <div class="faq-answer">
                                <p>We ship new features and improvements every two weeks. All updates are automatic —
                                    you never need to reinstall or reconfigure anything.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
        <section class="cta_section">
        <div class="container">
            <div class="content">
                <h2>Ready to Transform Your Communication?</h2>
                <p>
                    Join the exclusive early access program and be among the first enterprises to
                    deploy Ezead Al.
                </p>
                <div class="cta_btns">
                    <a href="#" class="btn1">
                        Request Early Access
                    </a>
                    <a href="#" class="btn2">
                        Talk to Sales
                    </a>
                </div>
            </div>
        </div>
    </section>
    </main>
    <footer class="footer">
    <div class="container">
        <hr class="topLine">
        <div class="row">
            <!-- Left Side -->
            <div class="col-lg-3 col-md-6 order-1">
                <div class="Part_A">
                    <figure class="eze-logo">
                        <a href="/">
                            <img class="F_Logo" src="https://eze.pics/ezead-chat-images/logo2.png" width="191"
                                height="50" alt="Footer Logo">
                        </a>
                    </figure>
                    <p>
                        EzeAD - Your trusted platform for free classified and auction listings. Buy, sell and connect
                        globally with ease.
                    </p>
                    <!-- Social Links -->
                    <div class="social">
                        <a href="#" target="_blank" rel="noopener" title="Facebook">
                            <i class="fa-brands fa-facebook"></i>
                            <span class="sr-only">Facebook</span>
                        </a>
                        <a href="#" target="_blank" rel="noopener" title="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                            <span class="sr-only">twitter</span>
                        </a>
                        <a href="#" target="_blank" rel="noopener" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                            <span class="sr-only">instagram</span>
                        </a>
                        <a href="#" target="_blank" rel="noopener" title="Pinterest">
                            <i class="fa-brands fa-pinterest"></i>
                            <span class="sr-only">pinterest</span>
                        </a>
                        <a href="#" target="_blank" rel="noopener" title="LinkedIn">
                            <i class="fa-brands fa-linkedin"></i>
                            <span class="sr-only">linkedin</span>
                        </a>
                    </div>
                    <!-- Apps Download -->
                    <!--<div class="Apps_Wrap">-->
                    <!--    <a href="https://play.google.com/store/apps/details?id=com.ezead.app&hl=en" target="_blank"-->
                    <!--        rel="noopener" class="footer_app">-->
                    <!--        <img src="https://eze.pics/banner-images/google_play.webp" width="120" height="40"-->
                    <!--            alt="google_play" loading="lazy" title="Google Play Store">-->
                    <!--    </a>-->
                    <!--    <a href="https://apps.apple.com/us/app/ezead-classified-auction/id6736458268" target="_blank"-->
                    <!--        rel="noopener" class="footer_app" title="App Store">-->
                    <!--        <img src="https://eze.pics/banner-images/Ios_download_button.webp" alt="app-store"-->
                    <!--            width="120" height="40" loading="lazy">-->
                    <!--    </a>-->
                    <!--</div>-->
                </div>
            </div>
            <!-- Middle Menus -->
            <div class="col-lg-6 col-md-12 order-3 order-lg-2">
                <div class="Part_B d-flex justify-content-between">
                    <!-- Community -->
                    <div class="footer-menu">
                        <h3 id="communityHeading">Community</h3>
                        <ul aria-labelledby="communityHeading">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Testimonials</a></li>
                            <li><a href="/blog">Gallery</a></li>
                        </ul>
                    </div>
                    <!-- About Us -->
                    <div class="footer-menu">
                        <h3 id="aboutHeading">About Us</h3>
                        <ul aria-labelledby="aboutHeading">
                            <li>
                                <a href="https://ezeadmedia.com/ezead-insight/" target="_blank" rel="noopener">
                                    Insights
                                </a>
                            </li>
                            <li><a href="#">How it Works</a></li>
                            <li><a href="#">Faqs</a></li>
                            <li><a href="#">Anti-Scam</a></li>
                        </ul>
                    </div>
                    <!-- Contact & Sitemap -->
                    <div class="footer-menu">
                        <h3 id="sitemapHeading">Support</h3>
                        <ul aria-labelledby="sitemapHeading">
                            <li><a href="#">Help & Support</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Newsletter -->
            <div class="col-lg-3 col-md-6 order-2 order-lg-3">
                <div class="Part_C">
                    <form id="newsletterForm">
                        <label for="sub_email">Newsletter</label>
                        <input type="email" id="sub_email" name="email" autocomplete="email"
                            placeholder="Your Email" required>
                        <button type="submit" title="Subscribe">
                            Subscribe
                        </button>
                        <span id="newsletterMsg"></span>
                    </form>
                    <p>
                      Free classifieds platform to buy, sell, and bid worldwide. Join EzeAD and expand your reach!
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <div class="footer_text text-center">
            <p>
               Free classifieds platform to buy, sell, and bid worldwide. Join EzeAD and expand your reach! @EzeAd 2003-2025
            </p>
        </div>
    </div>
    <!-- Back To Top -->
    <button class="back-to-top" aria-label="Back to top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>
    </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        const chatBox = document.getElementById('chatBox');
        const toggle = document.getElementById('chatToggle');
        const msgs = document.getElementById('msgs');
        const input = document.getElementById('msgInput');
        const sendBtn = document.getElementById('sendBtn');
        const pillAI = document.getElementById('pillAI');
        const pillAgent = document.getElementById('pillAgent');
        const qr = document.getElementById('quickReplies');

        let mode = 'ai';
        let isOpen = true;

        // Open by default
        chatBox.classList.add('open');
        toggle.querySelector('.ico-open').style.display = 'none';
        toggle.querySelector('.ico-close').style.display = 'inline-block';
        toggle.querySelector('.notif').style.display = 'none';
        initChat();

        // Toggle open/close
        toggle.addEventListener('click', () => {
            isOpen = !isOpen;
            chatBox.classList.toggle('open', isOpen);
            toggle.querySelector('.ico-open').style.display = isOpen ? 'none' : 'inline-block';
            toggle.querySelector('.ico-close').style.display = isOpen ? 'inline-block' : 'none';
            toggle.querySelector('.notif').style.display = isOpen ? 'none' : 'flex';
            if (isOpen && msgs.children.length === 0) initChat();
        });

        // Mode pills
        pillAI.addEventListener('click', () => switchMode('ai'));
        pillAgent.addEventListener('click', () => switchMode('agent'));

        function switchMode(m) {
            mode = m;
            pillAI.classList.toggle('active', m === 'ai');
            pillAgent.classList.toggle('active', m === 'agent');
            pushSys(m === 'ai' ?
                '🤖 Switched to AI mode — instant automated replies.' :
                '👤 Switched to Agent mode — live support (simulated).'
            );
        }

        // Quick reply buttons
        qr.querySelectorAll('.quick-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                input.value = btn.textContent.replace(/^.{2}/, '').trim();
                handleSend();
            });
        });

        function initChat() {
            pushSys('👋 Welcome to EzeAD Support!');
            pushBot(
                'Hi there! I\'m your AI support assistant. How can I help you today? You can ask me about billing, adding agents, analytics, automation, or anything else.');
        }

        function pushSys(text) {
            const d = document.createElement('div');
            d.className = 'sys-msg';
            d.textContent = text;
            msgs.appendChild(d);
            scroll();
        }

        function pushBot(text) {
            const row = document.createElement('div');
            row.className = 'msg-row bot';
            row.innerHTML = `
      <div class="msg-avatar"><i class="fa-solid fa-robot" style="font-size:12px"></i></div>
      <div>
        <div class="bubble">${text}</div>
        <div class="msg-time">${now()} · ${mode === 'ai' ? 'AI Agent' : 'Support Agent'}</div>
      </div>`;
            msgs.appendChild(row);
            scroll();
        }

        function pushUser(text) {
            const row = document.createElement('div');
            row.className = 'msg-row user';
            row.innerHTML = `
      <div class="msg-avatar">U</div>
      <div>
        <div class="bubble">${text}</div>
        <div class="msg-time">${now()}</div>
      </div>`;
            msgs.appendChild(row);
            scroll();
        }

        function showTyping() {
            const row = document.createElement('div');
            row.className = 'msg-row bot';
            row.id = 'typingRow';
            row.innerHTML = `
      <div class="msg-avatar"><i class="fa-solid fa-robot" style="font-size:12px"></i></div>
      <div class="bubble typing-bubble"><span></span><span></span><span></span></div>`;
            msgs.appendChild(row);
            scroll();
        }

        function hideTyping() {
            const t = document.getElementById('typingRow');
            if (t) t.remove();
        }

        function scroll() {
            msgs.scrollTop = msgs.scrollHeight;
        }

        function now() {
            return new Date().toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function n(s) {
            return (s || '').toLowerCase();
        }

        function getAIReply(t) {
            if (n(t).includes('billing') || n(t).includes('invoice') || n(t).includes('payment'))
                return "For billing queries, go to <b>Admin Console → Billing</b>. You can view invoices, update payment methods, or upgrade/downgrade your plan. Need help with a specific invoice?";
            if (n(t).includes('password') || n(t).includes('reset'))
                return "To reset your password: click <b>Forgot Password</b> on the login page → enter your email → verify via OTP → set a new password. Admins can also enforce MFA from security settings.";
            if (n(t).includes('agent') || n(t).includes('invite') || n(t).includes('add'))
                return "To add an agent: go to <b>Admin Console → Team → Invite Agent</b>. You can assign skills, set working hours, and configure routing rules so chats auto-assign to the best available agent.";
            if (n(t).includes('analytic') || n(t).includes('dashboard') || n(t).includes('report') || n(t).includes('csat'))
                return "The <b>Analytics Dashboard</b> tracks: response time, AI resolution rate, agent productivity, conversation volume, and CSAT scores. Use it to refine routing and improve your AI knowledge base.";
            if (n(t).includes('automat') || n(t).includes('workflow') || n(t).includes('rout'))
                return "Automation workflows can auto-tag chats, trigger escalations, assign priority, and route by department or skill. Example: billing → finance queue; technical → L2 agents; VIP → priority lane.";
            if (n(t).includes('hi') || n(t).includes('hello') || n(t).includes('hey'))
                return "Hey! 👋 I'm EzeAD's AI support agent. I can help you with billing, onboarding, adding agents, routing rules, analytics, or automations. What do you need?";
            if (n(t).includes('pricing') || n(t).includes('plan') || n(t).includes('cost'))
                return "We offer <b>Starter, Professional, and Enterprise</b> plans. Starter is great for small teams, Pro unlocks advanced AI training + workflows, and Enterprise adds custom infrastructure + SSO.";
            if (n(t).includes('integrat') || n(t).includes('api') || n(t).includes('webhook'))
                return "Integrations are available via <b>webhooks & REST API</b>: create tickets, sync CRM fields, post alerts to Slack/Email, and log conversation events for reporting.";
            return "Got it! Our platform handles instant AI replies + smart triage, escalating to human agents when needed. Could you share more details so I can guide you to the right solution?";
        }

        function getAgentReply(t) {
            if (n(t).includes('refund'))
            return "I can help with that! Please share your invoice ID and the reason for the refund. I'll verify eligibility and process it right away.";
            if (n(t).includes('bug') || n(t).includes('error') || n(t).includes('issue'))
            return "Sorry to hear that! Could you share a screenshot and the steps to reproduce? I'll escalate to our technical team with priority.";
            if (n(t).includes('upgrade') || n(t).includes('plan'))
            return "Sure! Tell me your current plan and expected number of agents. I'll recommend the best tier for your usage.";
            return "Thanks for reaching out! Could you share a bit more detail — account email + what you were trying to do? I'll take it from there right away.";
        }

        async function handleSend() {
            const text = input.value.trim();
            if (!text) return;
            input.value = '';
            qr.style.display = 'none';
            pushUser(text);
            showTyping();
            await new Promise(r => setTimeout(r, 500 + Math.random() * 600));
            hideTyping();
            const reply = mode === 'ai' ? getAIReply(text) : getAgentReply(text);
            pushBot(reply);
        }

        sendBtn.addEventListener('click', handleSend);
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') handleSend();
        });
    </script>
    <script>
        const sidebar = document.getElementById('light_sidebar');
        const overlay = document.getElementById('light_overlay');

        document.getElementById('light_openSidebar').onclick = () => {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        };

        document.getElementById('light_closeSidebar').onclick = () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        };

        overlay.onclick = () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        };
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        
        if (window.innerWidth > 767) return;
        
        const sections = document.querySelectorAll(
        ".explanatory, .wow_it_works, .pricing, .portals, .testimonials, .faqs, .cta_section, .footer"
        );
        
        sections.forEach(section => {
        section.style.display = "none";
        });
        
        function loadSections(){
        
        sections.forEach(section => {
        section.style.display = "block";
        });
        
        window.removeEventListener("scroll", loadSections);
        window.removeEventListener("click", loadSections);
        window.removeEventListener("touchstart", loadSections);
        window.removeEventListener("keydown", loadSections);
        
        }
        
        window.addEventListener("scroll", loadSections);
        window.addEventListener("click", loadSections);
        window.addEventListener("touchstart", loadSections);
        window.addEventListener("keydown", loadSections);
        
        });
        </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
          const blur = document.querySelector(".hero .blur3");
          const chatBtn = document.getElementById("chatToggle");
        
          if (!blur && !chatBtn) return;
        
          function activateElements() {
        
            // Blur show
            if (blur) {
              blur.style.display = "block";
              blur.classList.add("active");
            }
        
            // Button show
            if (chatBtn) {
              chatBtn.style.display = "flex";   // flex use kar rahe ho to flex hi rakho
            }
        
            // Run only once
            window.removeEventListener("mousemove", activateElements);
            window.removeEventListener("keydown", activateElements);
            window.removeEventListener("scroll", activateElements);
            window.removeEventListener("click", activateElements);
          }
        
          window.addEventListener("mousemove", activateElements);
          window.addEventListener("keydown", activateElements);
          window.addEventListener("scroll", activateElements);
          window.addEventListener("click", activateElements);
        });
</script>
    <script>
    var swiper = new Swiper(".howSwiper", {
      loop: true,
      spaceBetween: 30,
      navigation: {
        nextEl: ".wow_it_works .swiper-button-next",
        prevEl: ".wow_it_works .swiper-button-prev",
      },
      pagination: {
        el: ".wow_it_works .swiper-pagination",
        clickable: true,
      },
    });
    </script>
    <script>
        document.querySelectorAll('.faq-question').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var item = this.closest('.faq-item');
                var isOpen = item.classList.contains('open');
                document.querySelectorAll('.faq-item').forEach(function(el) {
                    el.classList.remove('open');
                    el.querySelector('.faq-question').setAttribute('aria-expanded', 'false');
                });
                if (!isOpen) {
                    item.classList.add('open');
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });
    </script>
    <script>
    // back-to-top button javascript
        if (document.querySelector('.back-to-top')) {
            const backToTopBtn = document.querySelector('.back-to-top');
            let scrollTimeout, cursorTimeout;
    
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY || document.documentElement.scrollTop;
    
                if (scrollPosition > 0) {
                    backToTopBtn.classList.add('show');
                    backToTopBtn.classList.remove('hide');
    
                    clearTimeout(scrollTimeout);
                    clearTimeout(cursorTimeout);
    
                    scrollTimeout = setTimeout(() => {
                        backToTopBtn.classList.add('hide');
                    }, 5000);
                } else {
                    backToTopBtn.classList.remove('show');
                    backToTopBtn.classList.add('hide');
                }
            });
    
            document.addEventListener('mousemove', () => {
                clearTimeout(cursorTimeout);
                clearTimeout(scrollTimeout);
    
                if (window.scrollY > 0) {
                    backToTopBtn.classList.add('show');
                }
    
                cursorTimeout = setTimeout(() => {
                    backToTopBtn.classList.add('hide');
                }, 5000);
            });
    
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    </script>

</body>

</html>