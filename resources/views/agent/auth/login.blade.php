@extends('layouts.neon', ['title' => 'Agent Login'])

@section('content')
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

      <form method="POST" action="{{ route('agent.login.submit') }}">
        @csrf

        <div class="field">
          <label for="email">Email:</label>

          <div class="input-wrap">
            <span class="icon"><i class="fa-regular fa-user"></i></span>

            <input 
              type="email"
              id="email"
              name="email"
              placeholder="agent@email.com"
              value="{{ old('email') }}"
              autocomplete="email"
              required
            />
          </div>

          @error('email')
          <div class="small text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>


        <div class="field">
          <label for="password">Password:</label>

          <div class="input-wrap">
            <span class="icon"><i class="fa-solid fa-lock"></i></span>

            <input 
              type="password"
              id="password"
              name="password"
              placeholder="••••••••"
              autocomplete="current-password"
              required
            />

            <button type="button" class="toggle-pw" id="togglePw" aria-label="Toggle password visibility">
              <i class="fa-regular fa-eye" id="pwIcon"></i>
            </button>
          </div>

          @error('password')
          <div class="small text-danger mt-1">{{ $message }}</div>
          @enderror
        </div>


        <button type="submit" class="btn-login">Log In</button>

        <div class="meta-row">
          <a href="#" class="forgot">Lost your password?</a>
        </div>

      </form>


      <div class="switch-portal">
        <p>Switch Portal</p>

        <div class="portal-btns">

          <a href="{{ route('admin.login') }}" class="btn-portal">
            Admin Login
          </a>

          <a href="{{ route('company.login') }}" class="btn-portal">
            Company Login
          </a>

        </div>
      </div>

    </div>
  </div>
</section>
@endsection
<!--<div class="row justify-content-center">-->
<!--    <div class="col-12">-->
<!--        <div class="neon-card p-4 p-md-5 neon-glow">-->
<!--            <h2 class="neon-title mb-1">Agent Console aleem</h2>-->
<!--            <p class="text-muted-neon mb-4">Support agent login</p>-->

<!--            <form method="POST" action="{{ route('agent.login.submit') }}">-->
<!--                @csrf-->
<!--                <div class="mb-3">-->
<!--                    <label class="form-label">Email</label>-->
<!--                    <input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="agent@email.com" required>-->
<!--                    @error('email') <div class="small text-danger mt-1">{{ $message }}</div> @enderror-->
<!--                </div>-->
<!--                <div class="mb-3">-->
<!--                    <label class="form-label">Password</label>-->
<!--                    <input name="password" type="password" class="form-control" placeholder="••••••••" required>-->
<!--                </div>-->
<!--                <button class="btn btn-neon w-100 py-2">Login</button>-->
<!--            </form>-->
<!--            <div class="login-switch mt-4 text-center">-->

<!--                <div class="mb-2 text-muted-neon small">-->
<!--                    Switch Portal-->
<!--                </div>-->
            
<!--                <div class="d-flex justify-content-center gap-2 flex-wrap">-->
            
<!--                    <a href="{{ route('admin.login') }}"-->
<!--                       class="btn btn-neon-outline btn-sm">-->
<!--                        Admin Login-->
<!--                    </a>-->
            
<!--                    <a href="{{ route('company.login') }}"-->
<!--                       class="btn btn-neon-outline btn-sm">-->
<!--                        Company Login-->
<!--                    </a>-->
<!--                </div>-->
            
<!--            </div>-->
<!--        </div>-->
<!--        <div class="text-center mt-3 small text-muted-neon">-->
<!--             Ezead Support Chat System • Admin Guard-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
