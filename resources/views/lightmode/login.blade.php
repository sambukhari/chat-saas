<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agent Console – Support Login</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
      <style>
      body {
            background:#f9f9f9;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
    .eze_logo{
        display:flex;
        align-items:start;
        justify-content:start;
        width: 224px;
        height: 63px;
        }
    .eze_logo img {
        width: 80%;
        height: auto;
        display: block;
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
      width: 450px;
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
      line-height: 32px;
      font-weight:700;
      color:#1a1a1a;
    }
    
    .admin_login .form_title span{
      font-size:14px;
      color:#666;
    }
    .admin_login form{
    display: flex;
    flex-direction: column;
    gap: 12px;
    }
    .admin_login .field{
    display: flex;
    flex-direction: column;
    gap: 5px;
    }
    
    .admin_login .field label{
      font-size:14px;
      font-weight:500;
      color:#333;
      display:block;
      margin-bottom:6px;
    }
    
    .admin_login .input-wrap{
      position:relative;
    }
    
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
    
    .admin_login .input-wrap input:focus{
      border-color:#0074A3;
    }
    
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
    
    .admin_login .btn-login:hover{
      background:#da741c;
    }
    
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
    .admin_login #remember{
        position:relative;
        top:2px;
    }
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
      gap:10px;
    }
    
    .admin_login .btn-portal{
      flex:1;
      height:40px;
      border-radius:6px;
      border:1px solid #0074A3;
      background:#00A9DA29;
      color:#0074A3;
      font-weight:600;
      cursor:pointer;
      transition:0.3s;
    }
    
    .admin_login .btn-portal:hover{
      background:#0074A3;
      color:#fff;
    }
    
    @media screen and (max-width:991px){
    .eze_logo {
        margin-bottom: 20px !important;
        }
    }
     @media screen and (max-width:767px){
         .admin_login {
        height: 95svh;
        }
    .eze_logo {
        width: 180px;
        height: 30px;
        margin: auto;
        align-items: center;
        justify-content: center;
    }
    .admin_login .form_title {
        margin-bottom: 15px;
    }
    .admin_login .login {
        width: 95%;
        padding: 20px 20px
        }
    .admin_login .switch-portal {
    margin-top: 15px;
}
.admin_login .form_title h2{
      font-size:20px;
      line-height: 26px;
    }
    .admin_login #remember {
    top: 0px;
}
    }
    
    </style>

  </style>
</head>
<body>

    <section class="admin_login">
      <div class="container">
           <figure class="eze_logo">
            <a href="/">
            <img class="F_Logo" src="https://eze.pics/ezead-chat-images/logo2.png" width="224" height="63" alt="Footer Logo">
            </a>
        </figure>
        <div class="login">
          <div class="form_title">
            <h2>Agent Console</h2>
            <span>Support Agent Login</span>
          </div>
          <form action="#">
            <div class="field">
              <label for="email">Email:</label>
              <div class="input-wrap">
                <span class="icon"><i class="fa-regular fa-user"></i></span>
                <input type="email" id="email" name="email" placeholder="frank@alltrac.co" value="frank@alltrac.co" autocomplete="email"/>
              </div>
            </div>
            <div class="field">
              <label for="password">Password:</label>
              <div class="input-wrap">
                <span class="icon"><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="password" name="password" placeholder="••••••••" value="mypassword123" autocomplete="current-password"/>
                <button type="button" class="toggle-pw" id="togglePw" aria-label="Toggle password visibility">
                  <i class="fa-regular fa-eye" id="pwIcon"></i>
                </button>
              </div>
            </div>
            <button type="submit" class="btn-login">Log In</button>
            <div class="meta-row">
              <label class="remember">
                <input type="checkbox" id="remember" name="remember"/>
                Keep me logged in
              </label>
              <a href="#" class="forgot">Lost your password?</a>
            </div>
          </form>
          <div class="switch-portal">
            <p>Switch Portal</p>
            <div class="portal-btns">
              <button type="button" class="btn-portal">Admin Login</button>
              <button type="button" class="btn-portal">Company Login</button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      const toggleBtn = document.getElementById('togglePw');
      const pwInput   = document.getElementById('password');
      const pwIcon    = document.getElementById('pwIcon');
    
      toggleBtn.addEventListener('click', () => {
        const isHidden = pwInput.type === 'password';
        pwInput.type   = isHidden ? 'text' : 'password';
        pwIcon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
      });
    </script>

</body>
</html>