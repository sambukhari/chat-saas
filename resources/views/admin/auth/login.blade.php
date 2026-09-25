@extends('layouts.neon', ['title' => 'Admin Login'])
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
        <h2>Admin Console</h2>
        <span>Support Admin Login</span>
      </div>

     <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="field">
          <label for="email">Email:</label>

          <div class="input-wrap">
            <span class="icon"><i class="fa-regular fa-user"></i></span>

            <input 
              type="email"
              id="email"
              name="email"
              placeholder="frank@alltrac.co"
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

          <a href="{{ route('agent.login') }}" class="btn-portal">
            Agent Login
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
